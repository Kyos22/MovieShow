<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = ['idCustomer','idPackage','idCart','startDate','endDate'];
    public $timestamps = false;

    public function Cart(){
        return $this->belongsTo(Cart::class,'idCart','id');
    }
    public function customer() {
        return $this->belongsTo(Account::class, 'idCustomer', 'id');
    }
    public function package() {
        return $this->belongsTo(Package::class, 'idPackage', 'id');
    }
    
}
