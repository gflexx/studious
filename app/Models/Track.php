<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'file',
        'owner_id',
        'price'
    ];

    public function owner(){
        return $this->belongsTo(User::class);
    }
}
