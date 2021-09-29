<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'owner_id',
        'track_id',
        'cart_id'
    ];

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function track(){
        return $this->belongsTo(Track::class, 'track_id');
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }
}
