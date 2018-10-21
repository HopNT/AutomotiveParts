<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 10/20/2018
 * Time: 2:54 PM
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

class AccessoryController extends Controller
{
    public function viewAccessoryDetail(){
        return view('web.accessory.accessory-detail');
    }
}
