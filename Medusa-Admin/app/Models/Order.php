<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillabe = ['user_id','status','subTotal','tax','shipping','total','coupon_id','name','phone','email','address','district','conscious','city','content'];

    public function coupon()
    {
        return $this->hasMany(coupon::class,'id','coupon_id');
    }
}
