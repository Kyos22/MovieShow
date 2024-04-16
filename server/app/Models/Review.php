<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['body','user_id','parent_id'];

    public function parent(){
        return $this->belongsTo(Review::class,'parent_id');
    }
    public function replies(){
        return $this->hasMany(Review::class,'parent_id');
    }


    
}