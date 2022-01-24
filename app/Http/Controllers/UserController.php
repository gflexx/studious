<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Message;
use App\Models\SessionAvailable;
use App\Models\Signing;
use App\Models\Studio;
use App\Models\studio_session;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // require authentication
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function profile(){
        $userId = auth()->id();
        $tracks = Track::where('owner_id', $userId)->get();
        $studio = Studio::where('owner_id', $userId)->get();
        $signing = Signing::where('user_id', $userId)->get();
        $signed_studio = [];
        $studio_sessions = [];
        $user = User::find($userId);

        // get cart associated with user
        $cart = Cart::where([
            ['owner_id', auth()->user()->id],
            ['checked_out', 0]
        ])
        ->get()
        ->reverse();

        // cart id array
        $cart_id = [];

        // check if cart is not null add cart id to array
        if(count($cart) > 0){
            foreach($cart as $cart){
                array_push($cart_id, $cart->id);
            }
            // get items associated to a cart
            $cartItems = CartItem::where('cart_id', $cart_id[0])->get();
            $cart_items = [];
            foreach($cartItems as $item){
                array_push($cart_items, $item->track_id);
            }

            // add session data
            session()->put('cart_id', $cart_id[0]);
            session()->put('cart_items', $cart_items);
            session()->put('num_cart_items', $cartItems->count());
        }

        // get signed studio then push to array
        foreach($signing as $signin){
            if(!in_array($signin->studio ,$signed_studio)){
                array_push($signed_studio, $signin->studio);
            }
        }

        $session_available = [];
        // check if has studio then get session availability and sessions
        if ($studio->count() > 0){
            $session_available = SessionAvailable::firstOrCreate(['studio_id' => $signed_studio[0]->id]);
            $studio_sessions = studio_session::where('studio_id', $signed_studio[0]->id)->get();
        } else{
            // get user sessions
            $studio_sessions = studio_session::where('user_id', $userId)->get();
        }


        // get messages sent or received by user
        $messages = Message::where([
            ['sender_id', $userId]
        ])->orWhere([
            ['receiver_id', $userId]
        ])->get()->reverse();

        // contact array
        $contactArr = [];

        // get contacts from messages add to contact array
        foreach($messages as $msg){
            if($msg->sender_id == $userId){
                if (!in_array($msg->receiver, $contactArr)){
                    array_push($contactArr, $msg->receiver);
                }
            } else{
                if (!in_array($msg->sender, $contactArr)){
                    array_push($contactArr, $msg->sender);
                }
            }
        }

        return view('users.index', [
            'tracks' => $tracks,
            'studio' => $studio,
            'signing' => $signing,
            'signed_studio' => $signed_studio,
            'contacts' => $contactArr,
            'session_available' => $session_available,
            'studio_sessions' => $studio_sessions,
        ]);
    }

    public function editProfile($user){
        $user = User::findOrFail($user);
        return view('users.edit', ['user' => $user]);
    }

    public function saveEdit(Request $request){
        $data = $this->validate($request, [
            'username' => 'required',
            'email' => 'required'
        ]);
        if($request->image){
            // get image name
            $imgName =  $request->file('image')->getClientOriginalName();
            // save file to storage
            $request->file('image')->move('user_images', $imgName);
            // save image to array
            $img = ['image' => $imgName];
        }
        // update details
        $usr = auth()->user()->id;
        $user = User::find($usr);
        $user->update(array_merge(
            $data,
            $img ?? []
        ));
        return redirect('users');
    }
}
