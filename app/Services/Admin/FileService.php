<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/11
 * Time: 0:21
 */

namespace App\Services\Admin;


class FileService
{

    private $path;

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function geAliyuntUrl()
    {

        return config("filesystems.disks.oss.url")."/".$this->getPath() ;
    }

}