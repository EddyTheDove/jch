<?php

namespace App\Http\Controllers\views\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function checkout ()
    {
        return view('front.payment.checkout');
    }
}
