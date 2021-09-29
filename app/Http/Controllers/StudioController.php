<?php

namespace App\Http\Controllers;

use App\Models\Studio;
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
        return view('studio.show', [
            'studio' => $studio,
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
        auth()->user()->studio()->create($data);
        return redirect('users');
    }

    public function editStudio(){
        return view('studio.edit');
    }

    public function saveEdit(){

    }
}
