<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'checked_out',
        'total'
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function cartItem(){
        return $this->hasMany(CartItem::class);
    }
}
