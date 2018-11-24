<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;

use App\Services\Admin\FileService;
use Illuminate\Support\Facades\Storage;
use Exception;

class FileController extends Controller
{
    /**
     * 上传头像
     *
     * @return mixed
     */
    public function uploadAvatar()
    {
        $file = request()->file("file");
        $fileService = new FileService();

        try {

            $path = Storage::disk('oss')->put('avatar', $file);
            $fileService->setPath($path);

        } catch (Exception $e) {
            return response()->errorAjax($e->getMessage());
        }

        return response()->ajax($fileService->geAliyuntUrl());
    }

}