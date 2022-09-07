<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    public function category()
    {
        return $this->hasMany(Category::class,'id','category_id');
    }
    public function brand()
    {
        return $this->hasMany(Brand::class,'id','brand_id');
    }
    public function stock()
    {
        return $this->hasMany(Product_stock::class,'product_id');
    }
}
