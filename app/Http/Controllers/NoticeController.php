<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    // require login fist
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createNotice(){

    }

    public function deleteNotice(){

    }


}
