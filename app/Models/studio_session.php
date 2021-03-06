<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studio_session extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id',
        'user_id',
        'is_seen',
        'is_accepted'
    ];

    public function studio(){
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
