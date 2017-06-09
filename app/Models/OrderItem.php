<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    public $fillable = [
        "order_id",
        "title",
        "quantity",
        "price",
    ];
}
