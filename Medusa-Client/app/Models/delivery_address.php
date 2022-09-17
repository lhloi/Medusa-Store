<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_address extends Model
{
    use HasFactory;
    protected $table = 'delivery_address';
    protected $fillable = ['user_id','id','name','phone','district','conscious','city','address','address_type','status'];

}
