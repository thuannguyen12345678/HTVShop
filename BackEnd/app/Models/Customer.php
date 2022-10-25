<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    function order(){
        return $this->belongsTo(Order::class);
    }
    function province(){
        return $this->hasMany(Province::class);
    }
    function district(){
        return $this->hasMany(District::class);
    }
    function ward(){
        return $this->hasMany(Ward::class);
    }
}
