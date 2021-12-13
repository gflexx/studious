<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Track;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request){
        // validate input
        $data = $this->validate($request, [
            'owner_id' => 'required',
            'track_id' => 'required',
            'text' => 'required',
        ]);

        $track_id = $request->track_id;

        // get track and create comment through track
        $track = Track::findOrFail($track_id);
        $track->comments()->create($data);

        return redirect()->route('show_track', $track_id);
    }
}
