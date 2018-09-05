<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/5
 * Time: 20:33
 */

namespace App\Facades\Admin\Common\Asynchronous;

use Illuminate\Support\Facades\Facade;

class AjaxFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'AjaxService';
    }

}