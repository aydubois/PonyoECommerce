<?php

namespace App;

use App\Address;
use App\ProductWithQuantity;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{

    protected $guarded = [];

    public function billingAddress(){
        return $this->belongsTo(Address::class);
    }
    public function productsWithQuantities(){
        return $this->hasMany(ProductWithQuantity ::class);
    }
}
