<?php namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;


class TestController extends Controller
{
    // 產生Html靜態網頁
    public function index()
    {
        // 網頁內文
        $str = "<html><body><h2>測試11產出</h2></body></html>";
        // 儲存路徑
        $path = "/home/vagrant/d-test/resources/views/test/";
        // 檔案名稱
        $fileName = "aa.blade.php";

        ob_start();
        $fp = fopen($path . $fileName, "w");
        fwrite($fp, $str);
        fclose($fp);
        return view("test.aa");
    }

}