<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    //get the content of the cart
    public function addToCart(Request $request)
    {
            // Get the guest token from headers
        $guestToken = $request->header('X-Guest-Token'); 

        // If no token, create one (new guest)
        if (!$guestToken) {
            $guestToken = Str::uuid();
        }

        // Bind cart to this token
        $cart = Cart::session($guestToken);
        // Validate the request data
        $validatedData=$request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'color' => 'required|string',
            'size' => 'required|integer',
        ]);
        //get the information of the product
        $product = Product::find($validatedData['product_id']);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        //get the product id
        $productId = $product->id;
        //get the product name
        $productName = $product->name;
        //get the product price
        $productPrice = $product->price;
        //get the product image
        $productImage = $product->image;
        //get the product quantity
        $productQuantity = $validatedData['quantity'];
        //get the product color
        $productColor = $validatedData['color'];
        //get the product size
        $productSize = $validatedData['size'];
        //get the compose product id
        $cartId = "{$productId}-{$productSize}-{$productColor}";

        //add the product to the cart
        $cart->add([
              'id' => $cartId, 
              'name' => $productName, 
             'price' => $productPrice, 
             'quantity'=>$productQuantity , 
             'attributes' => [
                'color' => $productColor,
                'size' => $productSize,
                'image' => $productImage,
             ]
        ]);

        return response()->json([
            'message' => 'Product added to cart successfully.',
            'guest_token' => $guestToken,
        ]);

    }


    //update the product in the cart
    public function updateCart(Request $request)
    {
        $guestToken = $request->header('X-Guest-Token');

        if (!$guestToken) {
            return response()->json(['error' => 'Guest token required'], 400);
        }
        //validate the request data
        $validatedData=$request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|integer',
        ]);
        $cart = Cart::session($guestToken); 

        //get the cart id using the product id, color and size
        $productId = $validatedData['product_id'];
        $productColor = $validatedData['color'];
        $productSize = $validatedData['size'];
        $cartId = "{$productId}-{$productSize}-{$productColor}";
        // Update the item in the cart
        $cart->update($cartId, array(
            'quantity' => $validatedData['quantity'], // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
          ));

        return response()->json([
            'message' => 'Product updated in cart successfully.',
        ]);
    }

    
    //get the content of the cart
    public function getCart(Request $request)
    {
        $guestToken = $request->header('X-Guest-Token');

        if (!$guestToken) {
            return response()->json(['error' => 'Guest token required'], 400);
        }

        $cart = Cart::session($guestToken); 

        // Check if the cart is empty
        if ($cart->isEmpty()) {
            return response()->json(['message' => 'Cart is empty.'], 200);
        }
        // Return the cart content
        return response()->json([
            'cart' => $cart->getContent(),
            'totalItems' => $cart->getTotalQuantity(),
            'totalPrice' => $cart->getTotal(),
        ]);
    }


    //remove the product from the cart
    public function removeFromCart(Request $request)
    {
        $guestToken = $request->header('X-Guest-Token');

        if (!$guestToken) {
            return response()->json(['error' => 'Guest token required'], 400);
        }
        //validate the request data
        $validatedData=$request->validate([
            'product_id' => 'required|integer',
            'color' => 'required|string',
            'size' => 'required|integer',
        ]);
        $cart = Cart::session($guestToken); 
        //get the product id
        $productId = $validatedData['product_id'];
        //get the product color
        $productColor = $validatedData['color'];
        //get the product size          
        $productSize = $validatedData['size'];
        //get the cart id using the product id, color and size
        $cartId = "{$productId}-{$productSize}-{$productColor}";
        // Remove the item from the cart
        $cart->remove($cartId);
        // Check if the item was removed successfully
        if (!$cart->get($cartId)) {
            return response()->json(['message' => 'Product removed from cart successfully.'], 200);
        }

        return response()->json([
            'message' => 'Product not removed from cart successfully.',
        ]);
    }

}

