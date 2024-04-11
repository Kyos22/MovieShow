<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualify extends Model
{
    protected $table = 'qualify';
    protected $fillable = ['nameQualification'];
    public $timestamps = false;
}
