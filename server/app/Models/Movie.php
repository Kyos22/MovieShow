<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = ['nameMovie','discription','releaseYear','runningTime','qualification','limitedAge','countries','genre','photoDetail','photoThumbnail','type','video','trailer','idAdmin'
    
];
public $timestamps=false;

}
