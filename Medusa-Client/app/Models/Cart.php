<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = ['user_id','status','address1','address2','district','conscious','city'];
    public function cart_item()
    {
        return $this->hasMany(Cart_item::class,'cart_id');
    }
}
