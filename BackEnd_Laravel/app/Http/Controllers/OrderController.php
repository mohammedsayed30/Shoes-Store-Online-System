<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Notifications\OrderNotification;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class OrderController extends Controller
{
    private $cart;
    //add order to the database
    public function addOrder(Request $request)
    {
        //get the total amount from the cart
        $this->cart = Cart::session($request->header('X-Guest-Token'));
        //get the user id 
        $user_id =  auth()->id();
        //get the total price from the cart
        $price =$this->cart->getTotal();
        //get the shipping address from the request
        $address = $request->input('address');
        //add the order to the database
        $order = new Order();
        $order->user_id = $user_id;
        $order->total_price = $price;
        $order->shipping_address = $address;
        $order->save();
        //make the order items
        $this->addOrderItems($order->id);
        //make notification
        $user = auth()->user();
        $order= Order::find($order->id);  
        $user->notify(new OrderNotification($order));
        //clear the cart
        $this->cart->clear();
        //return a success message
        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
    //add order items
    public function addOrderItems($order_id)
    {
        //get the cart items
        $cartItems = $this->cart->getContent();
        //loop through the cart items and add them to the order items
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order_id;
            $orderItem->product_variant_id = $item->id;
            $orderItem->product_name = $item->name;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->price;
            $orderItem->save();
        }
    }

}
