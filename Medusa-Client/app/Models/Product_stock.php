<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_stock extends Model
{
    use HasFactory;
    protected $table = 'product_stock';
    public function color()
    {
        return $this->hasMany(Product_color::class,'id','color_id');
    }
    public function size()
    {
        return $this->hasMany(Product_size::class,'id','size_id');
    }
}
