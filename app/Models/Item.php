<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','quantity','price','detail','img','color','size'];
    protected $table ='item';

    public function productos(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
