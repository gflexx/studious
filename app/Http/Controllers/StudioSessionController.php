<?php

namespace App\Http\Controllers;

use App\Models\SessionAvailable;
use Illuminate\Http\Request;

class StudioSessionController extends Controller
{
    // require login fist
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createSession(Request $request){

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

    public function deleteSession(Request $request){

    }

    public function rejectSession(Request $request){

    }
}
