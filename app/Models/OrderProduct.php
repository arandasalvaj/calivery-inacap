<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = ['status','subtotal','quantity','orderS_id','store_id','product_order','order_id','id'];
    protected $table ='order_product';
    public function productos(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
