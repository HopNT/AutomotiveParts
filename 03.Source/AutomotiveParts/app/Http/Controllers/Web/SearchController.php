<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 10/20/2018
 * Time: 2:38 PM
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(){
        return view('web.search.search-result');
    }
}
