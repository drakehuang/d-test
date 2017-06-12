<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    public $timestamps = true;

    public $fillable = [
        "psid",
    ];
}
