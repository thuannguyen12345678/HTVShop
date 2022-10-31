<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
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

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }
}
