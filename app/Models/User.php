<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studio(){
        return $this->hasOne(Studio::class, 'owner_id');
    }

    public function tracks(){
        return $this->hasMany(Track::class, 'owner_id');
    }

    public function signing(){
        return $this->hasMany(Signing::class, 'user_id');
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'owner_id');
    }

    public function sessions(){
        return $this->hasMany(studio_session::class, 'user_id');
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class, 'owner_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'owner_id');
    }

}
