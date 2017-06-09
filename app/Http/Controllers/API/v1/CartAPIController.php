<?php namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;




class CartAPIController extends Controller
{

    public function __construct()
    {

    }

    public function store (Request $request)
    {
        $input = $request->all();
        $cart = DB::table('carts');
        $createData['user_id']    = $input['user_id'];
        $createData['product_id'] = $input['product_id'];
        $cartObj = $cart->where($createData)->first();

        if ($cartObj) {
            $return['flag'] = 'false';
            $return['msg']  = '商品已加入購物車';
            return response($return, 200);
        }

        if($cart->insert($createData)) {
            $return['flag'] = 'true';
            $return['msg']  = 'success';
            return response($return, 200);
        }


    }

    public function show($member_id)
    {
        $cart         = DB::table('carts');
        $productStock = DB::table('product_stocks');
        $product      = DB::table('products');
        $productImage = DB::table('product_images');

        $cartObj = $cart->where('user_id', $member_id)->get();
        $response = [];

        foreach ($cartObj as $key => $cart) {
            $productObj      = $product->where('id', $cart->product_id)->first();
            $productStockObj = $productStock->where('product_id', $cart->product_id)->get();
            $productImageObj = $productImage->where('id', $cart->product_id)->first();
            $response[$key]['image']         = $productImageObj->path;
            $response[$key]['title']         = $productObj->title;
            $response[$key]['price']         = $productObj->price;

            // 庫存處理
            foreach ($productStockObj as $s_key => $stock) {
                $response[$key]['stock'][$s_key]['specification'] = $stock->specification;
                $response[$key]['stock'][$s_key]['quantity']      = $stock->stock;
            }

        }

        echo '<pre>';
        print_r($response);
        exit;
        // $cart = DB::table('product_stocks')->where('user_id', $member_id)->first();
    }

}
