<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function uploadAvatars($file,$imageDir)
    {

        Storage::disk('oss')->put('avatars', $file);
    }

}