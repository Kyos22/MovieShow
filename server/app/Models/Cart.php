<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['idCustomer','idPackage','quantity','total'];

    public $timestamps = false;

    public function package(){
        return $this->belongsTo(Package::class,'idPackage');   
    }
    
}
