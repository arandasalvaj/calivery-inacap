<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStore extends Model
{
    use HasFactory;
    protected $fillable = ['order_at','status','total','store_id','id','order_id','payment_id'];
    protected $table ='order_store';

    public function store(){
        return $this->belongsTo('App\Models\Store','store_id');
    }
    public function orden(){
        return $this->belongsTo('App\Models\Order','order_id');
    }
}
