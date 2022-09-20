<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    public function images(Type $var = null)
    {
        return $this->hasMany(product_images::class,'product_id');
    }

    /**
     * The roles that belong to the products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(tags::class, 'product_tags', 'product_id', 'tag_id');
    }
    public function stock(Type $var = null)
    {
        return $this->hasMany(product_stock::class,'product_id');
    }

}
