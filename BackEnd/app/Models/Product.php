<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'product_id','id');
    }
    public function image_products(){
        return $this->hasMany(ImageProducts::class, 'product_id','id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
