<?php

namespace App\Http\Controllers;

use App\Models\SessionAvailable;
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
            if(!in_array($signing->user->id, $userArr)){
                array_push($userArr, $signing->user->id);
            }
        }

        $availability = SessionAvailable::firstOrCreate(['studio_id' => $studio->id]);

        // get tracks with user ids found
        $tracks = Track::whereIn('owner_id', $userArr)->get();

        return view('studio.show', [
            'studio' => $studio,
            'tracks' => $tracks,
            'signings' => $signings,
            'availability' => $availability
        ]);
    }

    public function createStudio(){
        return view('studio.create');
    }

    public function saveStudio(Request $request){
        $data = $this->validate($request, [
            'title' => 'required',
            'session_fees' => 'required',
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

    public function editStudio($id){
        $studio = Studio::findOrFail($id);

        return view('studio.edit', [
            'studio' => $studio,
        ]);
    }

    public function saveEdit(Request $request){
        $studio_id = $request->studio_id;
        $studio = Studio::find($studio_id);

        // validate input
        $data = $this->validate($request, [
            'title' => 'required',
            'session_fees' => 'required',
            'description' => 'required'
        ]);

        if($request->image)
        {
            $imgName =  $request->file('image')->getClientOriginalName();
            // save file to storage
            $imgPath = $request->file('image')->move('studios', $imgName);
            // save image to array
            $imgArr = ['image' => $imgPath];
        }

        $studio->update(
            array_merge($data, $imgArr ?? [])
        );

        return redirect('users');

    }
}
