<?php namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ProductAPIController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        return view("products.product_detail");
    }


}
