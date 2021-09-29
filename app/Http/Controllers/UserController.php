<?php

namespace App\Http\Controllers;

use App\Models\Signing;
use App\Models\Studio;
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
        return view('users.index', [
            'tracks' => $tracks,
            'studio' => $studio,
            'signing' => $signing
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
        auth()->user()->update(array_merge(
            $data,
            $img ?? []
        ));
        return redirect('users');
    }
}
