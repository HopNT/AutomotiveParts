<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/28/2018
 * Time: 17:12
 */
namespace App\Http\Common\Utils;
use Illuminate\Support\Facades\Storage;

class CommonUtils
{
    public static function uploadFile($file, $category, $fileType)
    {
        $fileName = $file->getClientOriginalName();
        $storage = 'public/'.$category.'/'.$fileType;
        return $file->storeAs($storage, $fileName);
    }

    public static function getUrlFile($path)
    {
        return Storage::url($path);
    }

    public static function deleteFile($path)
    {
        Storage::delete($path);
    }

}
