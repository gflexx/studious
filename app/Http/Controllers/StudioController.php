<?php

namespace App\Http\Controllers;

use App\Models\Signing;
use App\Models\Studio;
use App\Models\Track;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index(){
        $studios = Studio::all();
        return view('studio.index', [
            'studios' => $studios
        ]);
    }

    public function showStudio($id){
        $studio = Studio::findOrFail($id);
        $signings = Signing::where('studio_id', $studio->id)->get();

        // create user array
        $userArr = [];

        // get user from studio signing
        foreach($signings as $signing){
            if(!in_array($signing->user, $userArr)){
                array_push($userArr, $signing->user->id);
            }
        }

        // get tracks with user ids found
        $tracks = Track::whereIn('owner_id', $userArr)->get();

        return view('studio.show', [
            'studio' => $studio,
            'tracks' => $tracks,
        ]);
    }

    public function createStudio(){
        return view('studio.create');
    }

    public function saveStudio(Request $request){
        $data = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg'
        ]);
        // get image name
        $imageName = $request->file('image')->getClientOriginalName();
        // save image to storage
        $imgPath = $request->file('image')->move('studios', $imageName);
        $data['image'] = $imgPath;
        // create studio
        $studio = auth()->user()->studio()->create($data);

        // sign owner to studio
        $studio->signings()->create(['user_id' => auth()->user()->id]);
        return redirect('users');
    }

    public function editStudio(){
        return view('studio.edit');
    }

    public function saveEdit(){

    }
}
