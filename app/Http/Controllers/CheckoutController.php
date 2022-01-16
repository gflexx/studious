<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(){
        return view('checkout.index', [

        ]);
    }

    public function finishCheckout(){
        return view();
    }
}
