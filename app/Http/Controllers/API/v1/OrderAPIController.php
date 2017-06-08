<?php namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe;



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
        $aa = new Stripe\Stripe();
        $aa->setApiKey("sk_test_QgzRzfAaLCDwxlt7wwFk1Wlq");
        // Token is created using Stripe.js or Checkout!
        // Get the payment token submitted by the form:
        $token = $input['stripeToken'];

        // Charge the user's card:
        $bb = new Stripe\Charge();
        $charge = $bb->create(array(
          "amount" => 1000,
          "currency" => "hkd",
          "description" => "Example charge",
          "source" => $token,
        ));

        if ($charge) {
            return redirect("https://www.messenger.com/closeWindow/?image_url=http://www.miankoutu.com/uploadfiles/2015-11-20/20151120225328226.png&display_text=%E4%BB%98%E6%AC%BE%E6%88%90%E5%8A%9F");
        }
    }


}
