<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','subtotal','product_id','cart_id','store_id'];
    protected $table ='cart_product';

    public function productos(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    
    public function carros(){
        return $this->belongsTo('App\Models\Cart','cart_id');
    }
}
