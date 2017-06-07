<?php namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;


class ChatBotAPIController extends Controller
{
    protected $page_token;

    public function __construct(Request $request)
    {
        $this->page_token = "EAASrkWmxF5IBAJ2LKttekATw14uITuYurz0fiioflZBF0abZA67ITmieKXS4KP0V4YSFfpZAfGbl4LWN7Eao1Ih3lxORr8t82FjYM8SjuAcl6PbiWBa03RB8TRA4I448z08coqtweCkRSstPPqROmgiQZBZAgZADAEi2IC6ZB0UugZDZD";

    }

   /**
    * Facebook Webhook 驗證
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
            $sender = $input['entry'][0]['messaging'][0]['sender']['id'];
            // 判斷是否為quick_reply
            if (isset($input['entry'][0]['messaging'][0]['message']['quick_reply']['payload'])) {

                switch ($input['entry'][0]['messaging'][0]['message']['quick_reply']['payload']) {
                    // 取得商品
                    case 'PRODUCT_LIST':
                        $this->typeOn($sender);
                        sleep(2);
                        // 處理User點擊[開始使用]的回應訊息
                        $this->sendProductList($sender);
                        break;
                }

            } else if (isset($input['entry'][0]['messaging'][0]['postback']['payload'])) { // 有設定postback的判斷

                switch ($input['entry'][0]['messaging'][0]['postback']['payload']) {
                    // 處理User點擊[開始使用]的回應訊息
                    case 'GET_STARTED_PAYLOAD':
                        $this->sendGreetingText($sender);
                        break;
                    // 處理詢問商品
                    case 'ASK_PRODUCT':
                        $this->typeOn($sender);
                        sleep(2);
                        $this->replyMessage($sender, '您好，請問需要詢問商品哪些事項');
                        break;
                }

            } else if (isset($input['entry'][0]['messaging'][0]['message']['text'])) {    // 一般訊息
                // 處理User發送訊息的回應訊息
                $this->replyMessage($sender, $input['entry'][0]['messaging'][0]['message']['text']);
            }

        }
    }

   /**
     * 傳送打字狀態
     *
     */
    public function typeOn($sender = null)
    {
        if(!is_null($sender)) {
            $url = "https://graph.facebook.com/v2.6/me/messages?access_token=" . $this->page_token;

            $replyArray['recipient']     = ['id'   => $sender];
            $replyArray['sender_action'] = "typing_on";
            $jsonData = json_encode($replyArray);

            $ch = curl_init($url);
            /* curl setting to send a json post data */
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_exec($ch);
        }
    }

   /**
    * 取得聊天室商品列表
    * @author Drake/2017.06.06
    *
    */

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

            // 透過psid取得用戶資訊
            $userInfoArray = $this->getUserInformationByPsid($sender);

            // 設定訊息
            $message = $greetingArray['data'][0]['greeting'][1]['text'] . "!!!" . $userInfoArray['first_name'] . " " .$userInfoArray['last_name'];

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
            curl_exec($ch); // user will get the message

            $this->typeOn($sender);
            sleep(2);

            $replyArray['message'] = ['text' => "Chat with us and ask questions, but remember: if at any time you want to speak to a Burberry consultant, you can find them in the menu at the bottom of your screen along with other options."];
            $jsonData = json_encode($replyArray);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_exec($ch); // user will get the message

            $this->typeOn($sender);
            sleep(2);

            $replyArray['message'] = ['text' => "PLAY WITH BEEMO! Put Beemo from Adventure Time on your device."];
            $jsonData = json_encode($replyArray);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_exec($ch); // user will get the message

            $this->typeOn($sender);
            sleep(2);

            $replyArray['message'] = [
                'text'          => "click the icon to get product list",
                'quick_replies' => [
                    [
                        "content_type" => "text",
                        "title"        => "🎁",
                        "payload"      => "PRODUCT_LIST"
                    ]
                ]
            ];

            $jsonData = json_encode($replyArray);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_exec($ch); // user will get the message
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

    /**
     * 透過PSID(傳入的sender id)取得用戶個人資料，PSID與FB登入API取得的ID不同，不可共用
     * @author Drake/2017.06.06
     * @param  Integer | $psid
     * @link   https://developers.facebook.com/docs/messenger-platform/user-profile
     * @return Array
     */
    private function getUserInformationByPsid($psid = null)
    {
        if(!is_null($psid)) {
            $url = "https://graph.facebook.com/v2.6/" . $psid . "?fields=first_name,last_name,profile_pic,locale,timezone,gender&access_token=" . $this->page_token;
            $userInformation = null;
            $userInformation = file_get_contents($url);
            if (!is_null($userInformation)) {
                return json_decode($userInformation, true);
            }
        }
    }

    /**
     * 回傳聊天室商品列表
     *
     *
     */
    private function sendProductList($sender = null)
    {
        if(!is_null($sender)) {
            // 設定call FB API的參數
            $replyArray['recipient'] = ['id'   => $sender];
            $replyArray['message']   = [
                'attachment' => [
                    "type"    => "template",
                    "payload" => [
                        "template_type" => "generic",
                        "elements"      => [
                            [
                                "title"          => "測試商品I",
                                "image_url"      => "http://static.friday.tw/mall/7731188/s_3990497_0ebcf75c210_o.jpg",
                                "subtitle"       => "顯示一小段商品描述",
                                "default_action" => [
                                    "type"                 => "web_url",
                                    "url"                  => "https://www.aibeemo.com/api/v1/product",
                                    "webview_height_ratio" => "tall",
                                    // "messenger_extensions"
                                    // "fallback_url"
                                    // "webview_share_button"
                                ],
                                "buttons" => [
                                    [
                                        "type"                 => "web_url",
                                        "url"                  => "https://www.aibeemo.com/api/v1/product",
                                        "title"                => "查看商品",
                                        "webview_height_ratio" => "tall"
                                    ],
                                    [
                                        "type"    => "postback",
                                        "title"   => "詢問商品",
                                        "payload" => "ASK_PRODUCT"
                                    ]
                                ]
                            ],
                            [
                                "title"          => "測試商品II",
                                "image_url"      => "http://static.friday.tw/mall/7731188/s_3990497_0ebcf75c210_o.jpg",
                                "subtitle"       => "顯示一小段商品描述II",
                                "default_action" => [
                                    "type"                 => "web_url",
                                    "url"                  => "https://www.aibeemo.com/api/v1/product",
                                    "webview_height_ratio" => "tall",
                                    // "messenger_extensions"
                                    // "fallback_url"
                                    // "webview_share_button"
                                ],
                                "buttons" => [
                                    [
                                        "type"                 => "web_url",
                                        "url"                  => "https://www.aibeemo.com/api/v1/product",
                                        "title"                => "查看商品",
                                        "webview_height_ratio" => "tall",
                                    ],
                                    [
                                        "type"    => "postback",
                                        "title"   => "詢問商品",
                                        "payload" => "ASK_PRODUCT"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];

            $jsonData = json_encode($replyArray);
            /*initialize curl*/
            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->page_token;
            $ch = curl_init($url);
            /* curl setting to send a json post data */
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_exec($ch); // user will get the message
            curl_close($ch);
        }
    }
}
