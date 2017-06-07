<?php namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class OrderAPIController extends Controller
{

    public function __construct()
    {

    }

    public function getCheckout(Request $request)
    {
        $input = $request->all();
        echo '<pre>';
        print_r($input);
        exit;
    }

    public function postCheckout(Request $request)
    {
        $input = $request->all();
        \Stripe\Stripe::setApiKey("sk_test_QgzRzfAaLCDwxlt7wwFk1Wlq");
        // Token is created using Stripe.js or Checkout!
        // Get the payment token submitted by the form:
        $token = $input['stripeToken'];

        // Charge the user's card:
        $charge = \Stripe\Charge::create(array(
          "amount" => 2000,
          "currency" => "hkd",
          "description" => "Example charge",
          "source" => $token,
        ));

        if ($charge) {
            echo '付款成功';
        }
    }


}
