<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_color extends Model
{
    use HasFactory;
    protected $table = 'product_color';
    public function stock()
    {
        return $this->hasMany(Product_stock::class,'color_id');
    }
}
