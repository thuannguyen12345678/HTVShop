<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    function customer(){
        return $this->hasMany(Course::class);
    }
    function order_detail(){
        return $this->belongsTo(Course::class);
    }
}
