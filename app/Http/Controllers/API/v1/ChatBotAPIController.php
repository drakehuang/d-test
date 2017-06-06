<?php namespace App\Http\Controllers\API\v1;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Course;


class ChatBotAPIController extends Controller
{
    protected $page_token;

    public function __construct()
    {
        $this->page_token = "EAASrkWmxF5IBAJ2LKttekATw14uITuYurz0fiioflZBF0abZA67ITmieKXS4KP0V4YSFfpZAfGbl4LWN7Eao1Ih3lxORr8t82FjYM8SjuAcl6PbiWBa03RB8TRA4I448z08coqtweCkRSstPPqROmgiQZBZAgZADAEi2IC6ZB0UugZDZD";
    }

   /**
    * Facebook Webhook 驗證
    *
    */
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

   /**
    * 接收Facebook User 傳送至粉絲團的訊息
    * @author Drake/2017.06.06
    * @link https://developers.facebook.com/docs/messenger-platform/webhook-reference/message
    */
    public function postFacebookWebhook(Request $request)
    {

        $input = $request->all();

        if (isset($input['entry'][0]['messaging'][0]['sender']['id'])) {
            // 首次進入的User，發送歡迎詞
            if (isset($input['entry'][0]['messaging'][0]['postback']['payload']) && $input['entry'][0]['messaging'][0]['postback']['payload'] == 'GET_STARTED_PAYLOAD') {
                // 處理User點擊[開始使用]的回應訊息
                $this->sendGreetingText($input['entry'][0]['messaging'][0]['sender']['id']);
            }

            // User傳送訊息
            if (isset($input['entry'][0]['messaging'][0]['message']['text'])) {
                // 處理User發送訊息的回應訊息
                $this->replyMessage($input['entry'][0]['messaging'][0]['sender']['id'], $input['entry'][0]['messaging'][0]['message']['text']);
            }
        }
    }

   /**
    * 對首次使用的用戶發送歡迎詞
    * @author Drake/2017.06.06
    * @param  Integer | $sender
    */
    private function sendGreetingText($sender = null)
    {
        if (!is_null($sender)) {
            // 取得設定好的歡迎詞URL
            $url = "https://graph.facebook.com/v2.6/me/messenger_profile?fields=greeting&access_token=" . $this->page_token;
            $greetingArray = json_decode(file_get_contents($url), true);

            // 設定訊息
            $message = $greetingArray['data'][0]['greeting'][1]['text'];

            // 回覆訊息給user的URL
            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->page_token;

            // 設定call FB API的參數
            $replyArray['recipient'] = ['id'   => $sender];
            $replyArray['message']   = ['text' => $message];
            $jsonData = json_encode($replyArray);

            /*initialize curl*/
            $ch = curl_init($url);
            /* curl setting to send a json post data */
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            if (!empty($message)) {
                $result = curl_exec($ch); // user will get the message
            }
        }
    }

   /**
    * 回覆訊息給Facebook User
    * @author Drake/2017.06.06
    * @param  Integer | $sender
    * @param  String  | $message
    */
    private function replyMessage($sender = null , $message = null)
    {
        if (!is_null($sender) && !is_null($message)) {

            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->page_token;

            // 設定call FB API的參數
            $replyArray['recipient'] = ['id'   => $sender];
            $replyArray['message']   = ['text' => $message];
            $jsonData = json_encode($replyArray);
            /*initialize curl*/
            $ch = curl_init($url);

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
