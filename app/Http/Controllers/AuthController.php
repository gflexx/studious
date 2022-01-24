<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginAuth(Request $request){
        // validate
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $username = $request->username;
        $pass = $request->password;
        // return error if credentials are incorect
        if(! Auth::attempt(['username' => $username, 'password' => $pass])){
            return back()->with('status', 'Incorrect email or password');
        }
        // redirect to profile
        return redirect('users');
    }

    public function logout(){
        // logout
        Auth::logout();

        //sanitize session
        session()->remove('cart_id');
        session()->remove('cart_items');
        session()->remove('num_cart_items');

        return redirect('/');
    }

    public function register(){
        return view('auth.register');
    }

    public function saveUser(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|confirmed'
        ]);
        $email = $request->email;
        $pass = $request->password;
        $username = $request->username;
        // create user
        User::create([
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($pass),
        ]);
        // login
        Auth::attempt(['email' => $email, 'password' => $pass]);
        // redirect to profile
        return redirect('users');
    }
}
