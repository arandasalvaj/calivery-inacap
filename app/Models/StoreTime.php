<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreTime extends Model
{
    use HasFactory;
    protected $fillable = ['time_start','time_end','status','day','store_id','id','name'];
    protected $table ='store_time';
}
