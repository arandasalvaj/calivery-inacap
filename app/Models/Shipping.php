<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = ['id','status','delivery_id','shipping_cost','user_id','created_at','orderStore_id'];
    protected $table ='shipping';
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function delivery(){
        return $this->belongsTo('App\Models\User','delivery_id');
    }
    public function ordenStore(){
        return $this->belongsTo('App\Models\OrderStore','orderStore_id');
    }
}
