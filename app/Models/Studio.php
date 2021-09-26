<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'owner_id'
    ];

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function signings(){
        return $this->hasMany(Signing::class, 'studio_id');
    }
}
