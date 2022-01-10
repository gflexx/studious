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

    public function notices(){
        return $this->hasMany(Notice::class, 'studio_id');
    }

    public function sessions(){
        return $this->hasMany(studio_session::class, 'studio_id');
    }

    public function availability(){
        return $this->hasOne(SessionAvailable::class, 'studio_id');
    }
}
