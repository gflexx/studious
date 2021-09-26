<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        return view('users.index');
    }

    public function editProfile(){
        return view('users.edit');
    }

    public function saveEdit(){

    }
}
