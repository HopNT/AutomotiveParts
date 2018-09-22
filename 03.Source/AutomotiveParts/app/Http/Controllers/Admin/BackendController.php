<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * return abort with 404 code
     * @return type
     */
    protected function error404(){
        if(Request::ajax()){
            return response()->json(['error' => 'Page Not found'], 404);
        }
        return abort(404);
    }


}
