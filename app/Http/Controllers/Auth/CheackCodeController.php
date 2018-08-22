<?php
/**
 * Created by PhpStorm.
 * User: zhong
 * Date: 2018/8/22
 * Time: 11:10
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CheackCodeController extends Controller
{

    public function index()
    {
        header("content-type:image/png");
        $validateLength=6;
        $strToDraw="";
        $chars=[
            "0","1","2","3","4",
            "5","6","7","8","9",
            "a","b","c","d","e","f","g",
            "h","i","j","k","l","m","n",
            "o","p","q","r","s","t",
            "u","v","w","x","y","z",
            "A","B","C","D","E","F","G",
            "H","I","J","K","L","M","N",
            "O","P","Q","R","S","T",
            "U","V","W","X","Y","Z"
        ];
        $imgW=150;
        $imgH=30;
        $imgRes=imagecreate($imgW,$imgH);
        $imgColor=imagecolorallocate($imgRes,0,255,300);
        $color=imagecolorallocate($imgRes,0,300,200);
        for($i=0;$i<$validateLength;$i++){
            $rand=rand(1,58);
            $strToDraw=$strToDraw." ".$chars[$rand];
        }
        imagestring($imgRes,5,15,5, $strToDraw, $color);
        for($i=0;$i<100;$i++){
            imagesetpixel($imgRes,rand(0,$imgW),rand(0,$imgH), $color);
        }
        dd(imagepng($imgRes));
        imagedestroy($imgRes);
    }

}