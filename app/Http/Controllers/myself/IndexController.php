<?php
/**
 * Created by PhpStorm.
 * User: zhongliu
 * Date: 2019-02-27
 * Time: 10:15
 */

namespace App\Http\Controllers\myself;


use App\Http\Controllers\Controller;
use Curl;
use Excel;


class IndexController extends Controller
{

    private $datas;

    private $start=0;

    public function index()
    {
        $this->datas = [];

        for ($i=0; $i<14; $i++) {
            $temp= $this->getData($i*1000, 1000);

            $this->datas = collect([$this->datas, $temp])->collapse()->all();
        }

        $rows = $this->datas;
        $cellDataTitle = [
            '学生','手机','省份','学校','学院','专业','学位','外语','政治','专业1','专业2','总分'
        ];

        $cellData = [];
        $cellData = collect($rows)->map(function($item, $key) {
            return [
                $item["name"],
                trim(($item["user"]? $item["user"]["mobile"]: "")),
                $item["major"]["college"]["school"]["province"]["area_name"],
                $item["major"]["college"]["school"]["name"],
                $item["major"]["college"]["name"],
                $item["major"]["name"],
                $item["major"]["degree"]==1? "学术学位": "专业学位",
                $item["foreign_language"],
                $item["politics"],
                $item["major1"],
                $item["major2"],
                $item["total_score"],
            ];
        })->all();

        $cellData = collect($cellData)->map(function ($item, $key) {
            $item = collect($item)->map(function ($v) {
                $v = htmlspecialchars($v, ENT_QUOTES);
                $v = preg_replace("/\r/", "\\r", $v);
                $v = preg_replace("/\n/", "\\n", $v);
                $v = trim($v);

                return $v;
            })->all();

            return $item;
        })->all();

        $fileName = '趣研通'.date('YmdHis');
        return response()->csv($cellData,$fileName,$cellDataTitle);
    }


    public function getData($offset=0, $limit=10) {
        $response = Curl::to("https://qyt.yidian360.com/admin/qyt/ajax/student/lists?order=desc&sort=id&offset={$offset}&limit={$limit}&status=1&province_id=0&token=719EB5B1-B966-7C1A-F574-517FD0B8E15F")
            ->get();

        $response = json_decode($response, true);
        $rows = $response["result"]["data"];

        return $rows;
    }
}