<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/28/2018
 * Time: 17:12
 */
namespace App\Http\Common\Utils;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CommonUtils
{
    public static function uploadFile($file, $category, $fileType)
    {
        $fileName = $file->getClientOriginalName();
        $storage = 'admin/images/'.$category;
        $file->move($storage, $fileName);
        return $storage.'/'.$fileName;
    }

    public static function getUrlFile($path)
    {
        return Storage::url($path);
    }

    public static function deleteFile($path)
    {
        File::delete($path);
    }

}
