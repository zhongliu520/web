<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;

use App\Services\Admin\FileService;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function upload()
    {
        $file = request()->file("file");
        $fileService = new FileService();

        $path = Storage::disk('oss')->put('avatar', $file);

        $fileService->setPath($path);

        return $this->ajax($fileService->geAliyuntUrl());
    }

}