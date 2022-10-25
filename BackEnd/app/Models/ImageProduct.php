<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'image_products';
    public function products(){
        return $this->belongsTo(Product::class);
    }
}
