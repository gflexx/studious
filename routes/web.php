<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', []);
});

// studio

Route::get('studios/all', [StudioController::class, 'index'])->name('studios_all');

Route::get('studio/add', [StudioController::class, 'createStudio'])->name('create_studio');

Route::post('studio/save', [StudioController::class, 'saveStudio'])->name('save_studio');

Route::get('studio/edit/{id}', [StudioController::class, 'editStudio'])->name('edit_studio');

Route::post('studio/edit/save', [StudioController::class, 'saveEdit'])->name('save_edit');

Route::get('studio/{id}', [StudioController::class, 'showStudio'])->name('show_studio');

// track

Route::get('tracks/all', [TrackController::class, 'index'])->name('tracks_all');

Route::get('track/{id}', [TrackController::class, 'showTrack'])->name('show_track');

Route::get('track/add', [TrackController::class, 'addTrack'])->name('add_track');

Route::post('track/save', [TrackController::class, 'saveTrack'])->name('save_track');

// users

Route::get('users/', [UserController::class, 'profile'])->name('profile');

Route::get('users/edit', [UserController::class, 'editProfile'])->name('edit_profile');

Route::post('users/save', [UserController::class, 'saveEdit'])->name('save_edit');

// auth

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('save/user', [AuthController::class, 'saveUser'])->name('save_user');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('login/authenticate', [AuthController::class, 'logiAuth'])->name('login_auth');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
