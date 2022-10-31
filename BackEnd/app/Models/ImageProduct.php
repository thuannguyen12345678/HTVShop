<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'image_products';
    protected $fillable = [
        'product_id','file_name'
    ];
    public function products(){
        return $this->belongsTo(Product::class);
    }
}
