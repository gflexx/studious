<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Track;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // require authentication
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $cart = Cart::where('owner_id', auth()->user()->id)
        ->orWhere(['checked_out' => 0])
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
            array_push($cart_id, 0);
        }

        // get items associated to a cart
        $cartItems = CartItem::where('cart_id', $cart_id[0])->get();
        return view('cart.index', [
            'cart' => $cart,
            'cart_items' => $cartItems,
        ]);
    }

    public function addToCart(Request $request){
        $item_id = $request->track_id;
        $cart_id = session()->get('cart_id');
        $track = Track::find($item_id);
        $cost = $track->price;
        $user = auth()->user()->id;
        // check if session has cart id
        if ($cart_id == null) {
            // create cart
            $cart = Cart::create([
                'owner_id' => $user,
            ]);

            // put cart id to session
            session()->put('cart_id', $cart->id);
            $data = array(
                'cart_id' => $cart->id,
                'owner_id' => $user,
                'track_id' => $track->id,
                'cost' => $cost
            );
            $cartItem = CartItem::create($data);

            // save cart total
            $cart->total = $cost;
            $cart->save();

            // put cart total in session
            session()->put('cart_total', $cart->total);

            // push item id to session items
            $items = [];
            array_push($items, $track->id);
            session()->put('cart_items', $items);
            session()->put('num_cart_items', count($items));
            return redirect()->route('show_track', [$track->id]);
        } else {
            // get cart and total
            $cart = Cart::find($cart_id);
            $cart_total = $cart->total;

            // get cart items
            $items = $cart->cartItem->all();
            $cart_items = array();
            foreach($items as $item){
                if(!in_array($item->track_id, $cart_items)){
                    array_push($cart_items, $item->track_id);
                }
            }

            // check if item in cart items
            $item_in_cart = in_array($track->id, $cart_items);

            // if not in array add cart item
            if(!$item_in_cart){
                $data = array(
                    'cart_id' => $cart->id,
                    'owner_id' => $user,
                    'track_id' => $track->id,
                    'cost' => $cost
                );
                $cartItem = CartItem::create($data);

                // put item in session cart items
                array_push($cart_items, $track->id);
                session()->put('cart_items', $cart_items);
                session()->put('num_cart_items', count($cart_items));

                // add cost and put in session
                $total = $cart_total + $cost;
                $cart->total = $total;
                $cart->save();
                session()->put('cart_total', $cart->total);
            }
            return redirect()->route('show_track', [$track->id]);
        }
    }

    public function removeFromCart(Request $request){
        $item_id = $request->track_id;
        $cart_id = session()->get('cart_id');
        $track = Track::find($item_id);

        // check if cart exists
        if($cart_id != null){
            $cost = $track->price;
            $cart = Cart::find($cart_id);
            $cart_items = session()->get('cart_items');

            // check if item in cart items
            $item_in_cart = in_array($track->id, $cart_items);
            if($item_in_cart){
                // remove item from cart items session array
                $key = array_search($track->id, $cart_items);
                unset($cart_items[$key]);

                // get and delete cartitem from db
                $item = CartItem::where([
                    ['cart_id', $cart->id],
                    ['track_id', $track->id]
                ])->get();

                foreach($item as $itm){
                    $itm->delete();
                }

                // update cart total
                $cart_total = $cart->total;
                $total = $cart_total - $cost;
                $cart->total = $total;
                $cart->save();

                // update session cart values
                session()->put('cart_items', $cart_items);
                session()->put('num_cart_items', count($cart_items));
                session()->put('cart_total', $cart->total);
            }
        }
        return redirect('cart');
    }
}
