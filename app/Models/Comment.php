<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'owner_id',
        'text',
    ];

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function track(){
        return $this->belongsTo(Track::class, 'track_id');
    }
}
