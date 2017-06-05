<?php namespace App\Http\Controllers\API\v1;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Course;


class ChatBotAPIController extends Controller
{
    public function __construct()
    {

    }

    public function getFacebookWebhook (Request $request)
    {
        if (isset($_GET['hub_verify_token'])) {
            if ($_GET['hub_verify_token'] === 'drakeTest') {
                echo $_GET['hub_challenge'];
                return;
            } else {
                echo 'Invalid Verify Token';
                return;
            }
        }
    }

    public function postFacebookWebhook(Request $request)
    {
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['entry'][0]['messaging'][0]['sender']['id']) && isset($input['entry'][0]['messaging'][0]['message']['text'])) {
            $sender = $input['entry'][0]['messaging'][0]['sender']['id']; //sender facebook id
            $message = $input['entry'][0]['messaging'][0]['message']['text'] ; //text that user sent
            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAASrkWmxF5IBAJ2LKttekATw14uITuYurz0fiioflZBF0abZA67ITmieKXS4KP0V4YSFfpZAfGbl4LWN7Eao1Ih3lxORr8t82FjYM8SjuAcl6PbiWBa03RB8TRA4I448z08coqtweCkRSstPPqROmgiQZBZAgZADAEi2IC6ZB0UugZDZD';
            /*initialize curl*/
            $ch = curl_init($url);
            /*prepare response*/
            $jsonData = '{
                "recipient":{
                    "id":"' . $sender . '"
                },
                "message":{
                    "text":" ' . $message . '"
                }
            }';

            /* curl setting to send a json post data */
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            if (!empty($message)) {
                $result = curl_exec($ch); // user will get the message
            }
        }
    }
}
