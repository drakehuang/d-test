<?php namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;


class TestController extends Controller
{
    // 產生Html靜態網頁
    public function index()
    {
        
        // 網頁內文
        $str = "<html><body><h2>測試產出=======</h2></body></html>";
        // 儲存路徑
        $path = "/home/vagrant/d-test/resources/views/activity/";
        // 先判斷是否有activity個資料夾
        if (!is_dir($path)) {
            // 沒有
            mkdir($path);
        }
        // 檔案名稱
        $viewPath = "activity03";
        $fileName = $viewPath . ".blade.php";

        $fp = fopen($path . $fileName, "w");
        fwrite($fp, $str);
        fclose($fp);

        return view("activity." . $viewPath);
    }

}