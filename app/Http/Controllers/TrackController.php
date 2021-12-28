<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Signing;
use App\Models\Studio;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index(){
        $tracks = Track::all();
        return view('tracks.index', [
            'tracks' => $tracks,
        ]);
    }

    public function showTrack($id){
        $track = Track::findOrFail($id);
        $comments = Comment::where('track_id', $track->id)
            ->get()
            ->reverse()
            ->values();
        return view('tracks.show', [
            'track' => $track,
            'comments' => $comments,
        ]);
    }

    public function addTrack(){
        return view('tracks.add');
    }

    public function saveTrack(Request $request){
        $data = $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,webp',
            'file' => 'required|mimes:mp3,wav,ogg,mp4',
            'price' => 'required|numeric'
        ]);
        $imgName = $request->file('image')->getClientOriginalName();
        $imgPath = $request->file('image')->move('track_images', $imgName);
        $fileName = $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->move('tracks', $fileName);
        $data['image'] = $imgPath;
        $data['file'] = $filePath;
        auth()->user()->tracks()->create($data);
        return redirect('users');
    }

    public function trackOwner($id){
        $owner = User::findOrFail($id);
        $tracks = Track::where('owner_id', $owner->id)->get();
        $signing = Signing::where('user_id', $owner->id);
        // dd($signing->studio_id);
        // $studio = Studio::where('studio_id', $signing->studio())->get();

        return view('tracks.owner', [
            'owner' => $owner,
            'tracks' => $tracks,
            'signing' => $signing,
        ]);
    }
}
