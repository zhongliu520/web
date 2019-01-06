<?php

namespace App\Services\Common;

use Exception;

class DownloadFile
{

    function down_images($url, $key=0) {

        try {
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
            curl_close($ch);

            if ($curlinfo['http_code'] == 200) {

                if ($curlinfo['content_type'] == 'image/jpeg') {

                    $exf = '.jpg';
                } else if ($curlinfo['content_type'] == 'image/png') {

                    $exf = '.png';
                } else if ($curlinfo['content_type'] == 'image/gif') {

                    $exf = '.gif';
                }

                $filename = ($key>0? $key: (date("YmdHis") . uniqid())) . $exf;//这里默认是当前文件夹，可以加路径的 可以改为$filepath = '../'.$filename
                $dir = "images/";

                if (!is_dir(storage_path("my/" . $dir))) {
                    mkdir(storage_path("my/" . $dir), 755, true);
                }

                $dir = storage_path("my/" . $dir);

                $filepath = $dir.$filename;
                file_put_contents($filepath, $content);
            }else {
                throw new Exception("下载失败!");
            }
        } catch (Exception $e) {

            throw new Exception("下载失败!");
        }
    }

}