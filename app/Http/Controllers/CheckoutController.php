<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use ZipArchive;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(){
        $cart = Cart::where([
            ['owner_id', auth()->user()->id],
            ['checked_out', 0]
        ])
        ->get()
        ->reverse();

        // cart id array
        $cart_id = [];

        // check if cart is not null add cart id to array
        if($cart->count() > 0){
            foreach($cart as $cart){
                if(!in_array($cart->id, $cart_id)){
                    array_push($cart_id, $cart->id);
                }
            }
        } else{
            return redirect('cart');
        }

        // get items associated to a cart
        $cartItems = CartItem::where('cart_id', $cart_id[0])->get();
        return view('checkout.index', [
            'cart' => $cart,
            'cartItems' => $cartItems,
        ]);
    }

    public function payment(Request $request){

        return redirect('checkout/finish');
    }

    public function finishCheckout(){
        session()->forget('num_cart_items');
        // get cart and cart items check it out
        $cart_id = session()->get('cart_id');
        if($cart_id != null){
            $cart = Cart::find($cart_id);
            $cart->checked_out = true;
            $cart->save();
            $cart_items = CartItem::where('cart_id', $cart->id)->get();

            // add cart item file and image to media array
            $cart_media = [];
            foreach($cart_items as $item){
                array_push($cart_media, $item->track->image);
                array_push($cart_media, $item->track->file);
            }

            // put the media to the session for download
            session()->put('download_items', $cart_media);
        }


        return view('checkout.finish');
    }

    public function download(Request $request){
        $cart_media = session()->get('download_items');

        // create zip archive
        $zip = new ZipArchive;
        $temp = 'assets/tract_items.zip';


         // create zip and download
         if($zip->open($temp, ZipArchive::CREATE)){
            foreach($cart_media as $media){
                $zip->addFile($media);
            }
            $zip->close();
            header('Content-disposition: attachement; filename = track_files.zip');
            header('Content-type: application/zip');

            // sanitize session
            session()->forget('cart_id');
            session()->forget('cart_items');
            session()->forget('num_cart_items');

            readfile($temp);
        }


    }
}
