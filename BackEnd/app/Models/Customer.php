<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    function order(){
        return $this->hasMany(Order::class);
    }
    function province(){
        return $this->belongsTo(Province::class);
    }
    function district(){
        return $this->belongsTo(District::class);
    }
    function ward(){
        return $this->belongsTo(Ward::class);
    }
}
