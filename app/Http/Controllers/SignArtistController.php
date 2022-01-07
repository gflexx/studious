<?php

namespace App\Http\Controllers;

use App\Models\Signing;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;

class SignArtistController extends Controller
{
    // require authentication
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function signArtist($id){
        $studio = Studio::findOrFail($id);

        // get all signings
        $signed_artists = Signing::all();

        $signedArr = [];

        // add all signed artists to array
        foreach($signed_artists as $sign){
            if(!in_array($sign->user->id, $signedArr)){
                array_push($signedArr, $sign->user->id);
            }
        }

        // get users except signed users
        $user_list = User::all()->except($signedArr);

        return view('studio.sign-artists', [
            'studio' => $studio,
            'user_list' => $user_list,
        ]);
    }

    // sign artist
    public function saveSign(Request $request){
        $data = $this->validate($request, [
            'user_id' => 'required',
            'studio_id' => 'required'
        ]);
        $user_id = $request->user_id;
        $studio_id = $request->studio_id;

        // find user then sign user
        $usr = User::find($user_id);
        $usr->signing()->create($data);

        return redirect()->route('sign_artist', $studio_id);
    }

    // unsign artists
    public function unsignArtist(Request $request){
        $sign_id  = $request->sign_id;
        $studio_id = $request->studio_id;

        // find sign then delete
        $signing = Signing::findOrFail($sign_id);
        $signing->delete();

        return redirect()->route('sign_artist', $studio_id);
    }
}
