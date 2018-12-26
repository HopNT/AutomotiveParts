<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 12/20/2018
 * Time: 12:06 AM
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;

class QueryManagementController
{
    public function index(){
        return view('admin.query_management.index');
    }

    public function runSQL(){
        $query_list = request()->get('query');
        $query_list =trim($query_list);
        $keyword = explode(' ', $query_list);
        $flag = 'statement';
        //get the first word => select or insert, update query
        //select => use DB::select
        //insert, update, delete => use DB::statement
        if(strtolower($keyword[0]) == 'select'){
            $flag = 'select';
        }
        $data = '';
        $error = '';
        $mes = '';
        try{
            if($flag == 'select'){
                $data = DB::select($query_list);
            } else {
                $queries = explode(';', $query_list);
                DB::transaction(function() use($query_list){
                    $queries = explode(';', $query_list);
                    foreach ($queries as $key => $query){
                        if(!empty($query)){
                            DB::unprepared(DB::raw($query));
                        }
                    }
                });
                DB::commit();
                $mes = 'Hoàn thành!';
            }
        } catch (\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
        }
        return [
            'data' => $data,
            'error' => $error,
            'mes' => $mes
        ];
    }
}
