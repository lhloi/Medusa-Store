<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    use HasFactory;
    protected $table = 'order_item';
    protected $fillable = ['order_id','id','product_id','name','price','quantity','total','size','color'];

    public function product()
    {
        return $this->hasMany(Products::class,'id','product_id');
    }
}
