<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','total','user_id','id'];
    protected $table ='cart';
    public function productos(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
