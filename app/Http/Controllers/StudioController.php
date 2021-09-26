<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index(){
        return view('studio.index');
    }

    public function showStudio(){
        return view('studio.show');
    }

    public function createStudio(){
        return view('studio.create');
    }

    public function saveStudio(){

    }

    public function editStudio(){
        return view('studio.edit');
    }

    public function saveEdit(){

    }
}
