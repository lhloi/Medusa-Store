<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillabe = ['user_id','status','subTotal','tax','shipping','total','name','phone','email','address','district','conscious','city','content'];
}
