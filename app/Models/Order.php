<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status_customer','quantity','id','order_at','status','total_order','shipping_cost','user_id','store_id','payment_id'];
    protected $table ='order';

    public function payment(){
        return $this->hasOne(Payment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function productos(){
        return $this->morphToMany(Product::class,'productable')->withPivot('quantity');
    }

}
