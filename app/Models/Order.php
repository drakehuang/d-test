<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public $timestamps = true;

    public $fillable = [
        "no",
        "member_id",
        "status",
        "sum",
        "email",
        "receiver_name",
        "receiver_phone",
        "receiver_mobile",
        "codezip",
        "address",
        "shipping_fee"
    ];
}
