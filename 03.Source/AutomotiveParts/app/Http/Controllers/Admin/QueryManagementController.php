<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 12/20/2018
 * Time: 12:06 AM
 */

namespace App\Http\Controllers\Admin;

class QueryManagementController
{
    public function index(){
        return view('admin.query_management.index');
    }

    public function runSQL(){
        dd(request()->all());
    }
}
