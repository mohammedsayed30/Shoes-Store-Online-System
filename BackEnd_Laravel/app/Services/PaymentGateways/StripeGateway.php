<?php
namespace App\Services\PaymentGateways;

use Stripe\Charge;
use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use App\Contracts\PaymentInterface;
use App\Http\Controllers\OrderController;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class StripeGateway implements PaymentInterface
{

    public function processPayment(Request $request)
    {
        //get the total amount from the cart
        $cart = Cart::session($request->header('X-Guest-Token'));
        //check if the cart is empty
        if($cart->isEmpty()) {
            return response()->json(['message' => 'the cart is empty.'], 400);
        }
        //check if the stock is available using the product id and size and color from the productvariant
        foreach ($cart->getContent() as $item) {
            //get the quantity of the item in the cart
            $requiredQuantity = $item->quantity;
            //get the stock of the product 
            $productVariant = $this->getProductsVariants($item);
            //get the product quantity from the database
            $productQuantity = $productVariant->stock;
            //check if the product quantity is available
            if($productQuantity < $requiredQuantity) {
                return response()->json(['message' => 'the product quantity is not available.'], 400);
            }
        }
        
        //set the stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));
        //get the total amount from the cart in pounds
        $totalAmount = $cart->getTotal();
        //convert the total amount to pennies
        $totalAmountInCents = $totalAmount * 100;
        

        //doule check the total amount is greater than zero
        if($totalAmountInCents <= 0) {
            return response()->json(['message' => 'the total amount should be greater than zero.'], 400);
        }
        
        try {
            Charge::create([
                'amount' => $totalAmountInCents , // Amount in cents
                'currency' => 'egp',
                'source' => $request->stripeToken,
                'description' => 'Test Payment',
            ]);
            //update the stock in the database for each product in the cart
             foreach ($cart->getContent() as $item) {
                //get the quantity of the item in the cart
                $requiredQuantity2 = $item->quantity;
                //get the stock of the product 
                $productVariant2 = $this->getProductsVariants($item);
                //check if the product  is available
                if($productVariant2 == null) {
                    return response()->json(['message' => 'the product is not available.'], 400);
                }

                DB::transaction(function() use ($productVariant2, $requiredQuantity2) {
                         DB::table('productvariations')
                         ->where('product_id', $productVariant2->product_id)
                        ->where('size', $productVariant2->size)
                        ->where('color', $productVariant2->color)
                        ->lockForUpdate()
                        ->decrement('stock', $requiredQuantity2);
                });
             }
             //create new order from the class OrderController
             $newOrder = new OrderController();
             //add the order and order_items  to the database
            $newOrder->addOrder($request);
            //register the payment in the database
            return response()->json(['message' => 'the payment  happened successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'there is an error in the  payment  process.',
            'error' => $e->getMessage(), ], 500);
        }
    }
    //get the products in the cart
    public function getProductsVariants($item)
    {
         //get the product variant id and the size and the color from the item
            $productVariantID= $item->id;
           
            //explode the three parts of the product variant
            $productParts = explode('-', $productVariantID);
            //get the product id 
            $productId  = intval($productParts[0]);
            //get the product size
            $productSize  = intval($productParts[1]);
            //get the product color
            $productColor  = $productParts[2]."";
            //get the product quantity from the database
            $productVariant = ProductVariation::where('product_id', $productId)
                ->where('size', $productSize)
                ->where('color', $productColor)
                ->first();
            //check if the product quantity is available
            return $productVariant;
    }
}