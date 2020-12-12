<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment_details;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function addPaymentDetails(Request $request){
        $payment = new Payment_details;
        $payment->credit_card_number = $request->credit_card;
        $payment->name  = $request->name;
        $payment->user_id = Auth::id();
        $payment->expiration = $request->expiration;
        $payment->cvv = $request->cvv;
        $payment->save();
        $response = array('status'=> 'success', 'message'=>'payment added to the list.');
        return $response;
    }
}