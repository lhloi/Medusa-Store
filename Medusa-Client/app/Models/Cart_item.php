<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    use HasFactory;
    protected $table = 'cart_item';
    protected $fillable = ['cart_id','product_id','price','quantity','name','size','color','image'];
    public function car_item()
    {
        return $this->hasMany(car_item::class,'car_id');
    }


}
