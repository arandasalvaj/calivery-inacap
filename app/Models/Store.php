<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','address_id','cellphone','banner','email','logo','user_id','rubro','created_at'];
    protected $table ='store';

    public function address(){
        return $this->belongsTo('App\Models\Address','address_id');
    }
}
