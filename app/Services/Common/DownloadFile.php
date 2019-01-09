<?php

namespace App\Services\Common;

use Exception;

class DownloadFile
{

    function down_images($url, $key=0, $dir="my/images/", $downloadUrl = "") {

        try {

            preg_match_all("/(\.\.\/)/", $downloadUrl, $rows);
            $rowsCollect = collect($rows[1]);
            $count = $rowsCollect->count();
            $pattern = "/^((https?\:\/\/[^\/]*\/)(([^\/]*?\/)*))(([^\/]*?\/){%s})([^\/]*)$/";
            $pattern = sprintf($pattern, $count);
            $downloadUrl = preg_replace($pattern, "$1", $downloadUrl);
            $url = $downloadUrl.preg_replace("/^(((\.)+\/)*)(([^\/]*\/)*[^\/]*)$/", "$4", $url);
            logger('App\Services\Common', [json_encode($url)]);

            $header = array("Connection: Keep-Alive", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Pragma: no-cache", "Accept-Language: zh-Hans-CN,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3", "User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:29.0) Gecko/20100101 Firefox/29.0");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            //curl_setopt($ch, CURLOPT_HEADER, $v);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
            $content = curl_exec($ch);
            $curlinfo = curl_getinfo($ch);
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
                $dir = storage_path($dir);

                if (!is_dir($dir)) {
                    mkdir($dir, 755, true);
                }

                $filepath = $dir.$filename;
                file_put_contents($filepath, $content);
                logger('App\Services\Common', [json_encode($filepath)]);
            }else {
                logger('App\Services\Common', [json_encode($url)]);
            }
        } catch (Exception $e) {
            logger('App\Services\Common', [json_encode($url), "下载失败!"]);
            throw new Exception("下载失败!");
        }
    }

}