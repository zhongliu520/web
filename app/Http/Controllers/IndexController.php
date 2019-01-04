<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/6/1
 * Time: 0:16
 */

namespace App\Http\Controllers;


class IndexController extends  Controller
{

    public function index()
    {
        $rows = config("test.test");
        foreach ($rows as $key=>$item)
        {
//            $item = file_get_contents($item);
//            $myfile = fopen("testfile.txt", "w");
//            $item = base64_decode($item);
//            dd($item);
            $this->down_images($item, ($key+1));
        }
        dd($rows);
        return view("myself/test", ["rows"=>$rows]);
    }


    function down_images($url, $key=0) {


        $header = array("Connection: Keep-Alive", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Pragma: no-cache", "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3", "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:29.0) Gecko/20100101 Firefox/29.0");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        //curl_setopt($ch, CURLOPT_HEADER, $v);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        $content = curl_exec($ch);

        $curlinfo = curl_getinfo($ch);

        //print_r($curlinfo);

        //关闭连接

        curl_close($ch);


        if ($curlinfo['http_code'] == 200) {

            if ($curlinfo['content_type'] == 'image/jpeg') {

                $exf = '.jpg';

            } else if ($curlinfo['content_type'] == 'image/png') {

                $exf = '.jpg';

            } else if ($curlinfo['content_type'] == 'image/gif') {

                $exf = '.gif';

            }

            $filename = ($key>0? $key: (date("YmdHis") . uniqid())) . $exf;//这里默认是当前文件夹，可以加路径的 可以改为$filepath = '../'.$filename
            $dir = __DIR__."/../../../storage/my/images";
            $dir = iconv("UTF-8", "GBK", $dir);

            $filepath = $dir.'/'.$filename;
            if (!file_exists($dir)){
                mkdir ($dir,777,true);
            }
            $res = file_put_contents($filepath, $content);
            //$res = file_put_contents($filename, $content);//同样这里就可以改为$res = file_put_contents($filepath, $content);
            //echo $filepath;
//            echo $res;
        }
    }

}