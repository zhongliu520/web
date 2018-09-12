<?php

namespace App\Services\Admin;


use App\Models\Admin\Menus;

class MenuService
{

    private $start=0;

    private $length=10;

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @param int $start
     */
    public function setStart(int $start)
    {
        $this->start = $start;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length)
    {
        $this->length = $length;
    }


    public function getList()
    {

        return Menus::skip($this->getStart())->take($this->getLength())->get();

    }

}