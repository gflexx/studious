<?php

namespace App\Http\Controllers;

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

    public function acceptSession(Request $request){

    }

    public function deleteSession(Request $request){

    }

    public function rejectSession(Request $request){

    }
}
