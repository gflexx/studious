<?php

namespace App\Http\Controllers;

use App\Models\SessionAvailable;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioSessionController extends Controller
{
    // require login fist
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createSession($id){
        $studio = Studio::findOrFail($id);

        return view('studio.book', [
            'studio' => $studio,
        ]);
    }

    public function updateAvailability(Request $request){
        $studio_id = $request->studio_id;
        $is_available = $request->is_available;
        $status = 0;
        if ($is_available){
            $status = 1;
        }

        // get studio then update availability
        $availability = SessionAvailable::firstOrCreate(['studio_id' => $studio_id]);
        $availability->is_available = $status;
        $availability->save();

        return redirect('users');
    }

    public function acceptSession(Request $request){

    }

    public function saveSession(Request $request){
        $studio_id = $request->studio_id;
        $user_id = $request->user_id;
        $phonenumber = $request->phonenumber;

        // get studio and save studio session
        $studio = Studio::findOrFail($studio_id);
        $studio->sessions()->create(['user_id' => $user_id]);

        return redirect()->route('show_studio', ['id' => $studio_id])
        ->with('status', 'The studio will send you a message with your session details.');
    }

    public function deleteSession(Request $request){

    }

    public function rejectSession(Request $request){

    }
}
