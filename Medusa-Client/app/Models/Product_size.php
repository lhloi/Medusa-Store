<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_size extends Model
{
    use HasFactory;
    protected $table = 'product_size';
    public function stock()
    {
        return $this->hasMany(Product_stock::class,'size_id');
    }
}
