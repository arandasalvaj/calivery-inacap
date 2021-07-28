<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','stock','detail','status','img','category_id','size','store_id','price','id','color',];
    protected $table ='product';

    public function carts(){
        return $this->morphedByMany(Cart::class,'productable')->withPivot('quantity');
    }
    public function ordes(){
        return $this->morphedByMany(Order::class,'productable')->withPivot('quantity');
    }
    public function categoria(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
