<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class ProductAPIController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        #return view("products.product_detail");
        return view("order.payment_success");
    }

    public function show($product_id)
    {
        $product      = DB::table("products");
        $productStock = DB::table('product_stocks');
        $productImage = DB::table('product_images');

        $productObj      = $product->where("id", $product_id)->first();
        $productStockObj = $productStock->select("specification", "stock")->where('product_id', $product_id)->get();
        $productImageObj = $productImage->select("path", "sort")->where('product_id', $product_id)->get();

        $return = [];

        $return['flag'] = "true";

        $return['data']['title']       = $productObj->title;
        $return['data']['price']       = $productObj->price;
        $return['data']['description'] = $productObj->description;
        $return['data']['images'] = $productImageObj->toArray();
        $return['data']['stocks'] = $productStockObj->toArray();
// echo '<pre>';
// print_r($return);
// exit;
        return view("products.product_detail", $return);
    }


}
