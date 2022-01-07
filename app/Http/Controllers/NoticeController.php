<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Studio;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    // require login fist
    public function __construct()
    {
        $this->middleware('auth');
    }

    // create notice
    public function createNotice(Request $request){
        $image = $request->image;
        $text = $request->text;
        $studio_id = $request->studio_id;

        // if image and text empty redirect to profile
        if(!$image && !$text){
            return redirect('users');
        }

        // save image if image exists
        if($image){
            // get image name
            $imageName = $request->file('image')->getClientOriginalName();

            // save file to storage
            $request->file('image')->move('notices', $imageName);

            // make image array
            $image = ['image' => $imageName];
        }

        // save studio id to data id
        $data = ['studio_id' => $studio_id,];

        // check if text exists then create array
        if($text){
            $text = ['text' => $text];
        }

        // create notice by merging arrays
        Notice::create(array_merge(
            $data,
            $image ?? [],
            $text ?? []
        ));

        return redirect('users');
    }

    // delete notice
    public function deleteNotice(Request $request){
        $notice_id = $request->notice_id;
        $studio_id = $request->studio_id;

        // find and delete notice
        $notice = Notice::findOrFail($notice_id);
        $notice->delete();

        // redirect to studio
        return redirect()->route('show_studio', ['id' => $studio_id]);
    }
}
