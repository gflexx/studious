<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'studio_id',
        'is_visible',
        'image',
        'text'
    ];

    public function studio(){
        return $this->belongsTo(Studio::class, 'studio_id');
    }
}
