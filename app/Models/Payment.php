<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['id','amount','status','payed_at','order_id'];
    protected $table ='payment';

    public function order(){
        return $this->belongsTo(Order::class);
    }
    
}

