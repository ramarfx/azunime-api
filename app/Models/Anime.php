<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'episode',
        'image',
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'anime_genres');
    }
}
