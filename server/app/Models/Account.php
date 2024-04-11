<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $fillable = ['id','username','password','fullname','email','firstName','lastName','subscription','role','status','created'];
    public $timestamps=false;
}
