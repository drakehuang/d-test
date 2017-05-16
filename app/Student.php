<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';

    public $timestamps = false;

    public $fillable = [
        "name",
        "birthday",
        "registerDate",
        "remark"
    ];

    public function scopeSearchStudent($query, $input)
    {
        if (!empty($input['id'])) {
            $query = $query->where('id', '=', $input['id']);
        }

        if (!empty($input['name'])) {
            $query = $query->where('name', '=', $input['name']);
        }

        if (!empty($input['registerDate'])) {
            $query = $query->where('registerDate', '=', $input['registerDate']);
        }

        return $query;
    }

}
