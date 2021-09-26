<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index(){
        return view('tracks.index');
    }

    public function showTrack(){
        return view('tracks.show');
    }

    public function addTrack(){
        return view('tracks.add');
    }

    public function saveTrack(){

    }
}
