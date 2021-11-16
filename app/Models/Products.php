<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    use HasFactory;

    public function productimages()
    {
        return $this->hasMany('App\Models\ProductImages', 'product_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\Models\ProductSubcategory', 'product_id');
    }

    

}
