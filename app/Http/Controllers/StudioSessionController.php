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

    public function createSession(){

    }

    public function acceptSession(){

    }

    public function deleteSession(){

    }

    public function rejectSession(){

    }
}
