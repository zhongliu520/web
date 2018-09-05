<?php

namespace App\Services\Admin\Common\Asynchronous;


class AjaxService
{
    private $msg="";

    public function getMsg()
    {
        return $this->msg;
    }

    public function setMsg($msg = "")
    {
        $this->msg = $msg;
    }

    private $code=200;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code = 200)
    {
        $this->code = $code;
    }

    private $data=[];

    public function getData()
    {
        return $this->data;
    }

    public function setData($data = array())
    {
        $this->data = $data;
    }


    public function responseJson()
    {

        return response()->json(["code" => $this->getCode(), "msg" => $this->getMsg(), "data" => $this->getData()]);
    }

}