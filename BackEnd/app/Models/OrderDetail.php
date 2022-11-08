<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_price','product_quantity','product_id','order_id','product_total_price'
    ];
    protected $table = 'order_details';
    function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    function orders(){
        return $this->belongsTo(Order::class);
    }
    function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
