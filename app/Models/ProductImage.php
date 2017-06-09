<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public $fillable = [
        "product_id",
        "path",
        "sort"
    ];
}
