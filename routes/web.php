<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SignArtistController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;
use App\Models\Studio;
use App\Models\Track;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $studios = Studio::all();
    $tracks = Track::all();
    return view('home', [
        'studios' => $studios,
        'tracks' => $tracks
    ]);
});

// studio

Route::get('studios/all', [StudioController::class, 'index'])->name('studios_all');

Route::get('studio/add', [StudioController::class, 'createStudio'])->name('create_studio')->middleware(['auth']);

Route::post('studio/save', [StudioController::class, 'saveStudio'])->name('save_studio')->middleware(['auth']);

Route::get('studio/edit/{id}', [StudioController::class, 'editStudio'])->name('edit_studio')->middleware(['auth']);

Route::post('studio/edit/save', [StudioController::class, 'saveEdit'])->name('save_edit');

Route::get('studio/{id}', [StudioController::class, 'showStudio'])->name('show_studio');

// signing of artists

Route::get('studio/{id}/sign', [SignArtistController::class, 'signArtist'])->name('sign_artist');

Route::post('studio/sign/save', [SignArtistController::class, 'saveSign'])->name('save_sign');

Route::post('studio/sign/delete', [SignArtistController::class, 'unsignArtist'])->name('unsign_artist');

// track

Route::get('tracks/all', [TrackController::class, 'index'])->name('tracks_all');

Route::get('track/show/{id}', [TrackController::class, 'showTrack'])->name('show_track');

Route::get('track/add', [TrackController::class, 'addTrack'])->name('add_track')->middleware(['auth']);

Route::post('track/save', [TrackController::class, 'saveTrack'])->name('save_track');

Route::get('tracks/owner/{id}', [TrackController::class, 'trackOwner'])->name('track_owner');

// comments

Route::post('comments/add', [CommentController::class, 'addComment'])->name('add_comment')->middleware(['auth']);

// users

Route::get('users/', [UserController::class, 'profile'])->name('profile');

Route::get('users/edit/{id}', [UserController::class, 'editProfile'])->name('edit_profile');

Route::post('users/save', [UserController::class, 'saveEdit'])->name('save_edit');

// messages

Route::get('messages/chat/{id}', [MessagesController::class, 'chat'])->name('chat');

Route::post('messages/save', [MessagesController::class, 'save'])->name('save_message');

// notices

Route::post('notices/create', [NoticeController::class, 'createNotice'])->name('create_notice');

Route::post('notices/delete', [NoticeController::class, 'deleteNotice'])->name('delete_notice');

// studio sessions

Route::post('sessions/create', [StudioSessionController::class, 'createSession'])->name('create_session');

Route::post('sessions/accept', [StudioSessionController::class, 'acceptSession'])->name('accept_session');

Route::post('sessions/reject', [StudioSessionController::class, 'rejectSession'])->name('reject_session');

Route::post('sessions/delete', [StudioSessionController::class, 'deleteSession'])->name('delete_session');

// auth

Route::get('register', [AuthController::class, 'register'])->name('register');

Route::post('save/user', [AuthController::class, 'saveUser'])->name('save_user');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('login/authenticate', [AuthController::class, 'loginAuth'])->name('login_auth');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// cart

Route::get('cart', [CartController::class, 'index'])->name('cart');

Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart_add');

Route::post('cart/remove', [CartController::class, 'removeFromCart'])->name('cart_remove');
