<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/5/2018
 * Time: 1:54 AM
 */

namespace App\Http\Common\DAO;


use App\Http\Common\Entities\UserDb;
use App\Http\Common\Enum\GlobalEnum;
use Illuminate\Support\Facades\DB;

class UserDAO extends UserDb
{
    /**function get all user in system
     * @return \Illuminate\Support\Collection
     */
    public function getAllUser(){
        $data = DB::table('tbl_user as u')
            ->leftJoin('tbl_role as r','u.role_id','=','r.id')
            ->where('u.status','=',GlobalEnum::STATUS_ACTIVE)->get();
        return $data;
    }
}
