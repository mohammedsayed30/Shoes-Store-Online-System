<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Contracts\PaymentInterface;

class PaymentController extends Controller
{
    //define the payment method
    private PaymentInterface  $payment;
    //constructor
    public function __construct(PaymentInterface $payment)
    {
        //initialize the payment method
        $this->payment = $payment;
    }


    //handle the payment
    public function processPayment(Request $request)
    {
        //define the payment method
       return $this->payment->processPayment($request);      
    }
}
