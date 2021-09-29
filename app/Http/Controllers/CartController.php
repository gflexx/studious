<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // require authentication
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        // $cart = Cart::find('owner_id', auth()->user()->id);
        // $cartItem = CartItem::where('cart_id', $cart->id)->get();
        return view('cart.index');
    }

    public function addToCart(){

    }

    public function removeFromCart(){

    }
}
