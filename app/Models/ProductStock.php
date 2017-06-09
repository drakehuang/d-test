<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stocks';

    public $fillable = [
        "product_id",
        "specification",
        "stock"
    ];
}
