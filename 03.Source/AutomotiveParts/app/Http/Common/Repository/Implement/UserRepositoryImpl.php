<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:23
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\UserDb;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\UserRepository;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl extends GenericRepositoryImpl implements UserRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return UserDb::class;
    }

    public function searchByText($text) {
        $listUser = DB::table('tbl_user')
            ->whereRaw("status = ".GlobalEnum::STATUS_ACTIVE." AND user_type = ".GlobalEnum::PROVIDER." AND (code LIKE ('%".$text."%') OR name LIKE ('%".$text."%') OR phone_number LIKE ('%".$text."%') OR email LIKE ('%".$text."%'))")
            ->get();
        return $listUser;
    }

    public function getAllJoinDataWithProductProvider($userId)
    {
        return DB::table('tbl_user_accessary as ua')
            ->join('tbl_user as u', 'ua.user_id', '=', 'u.user_id')
            ->join('tbl_accessary as a', 'ua.accessary_id', '=', 'a.accessary_id')
            ->where('u.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('a.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('u.user_id', '=', $userId)
            ->select('u.name as user', 'a.code', 'a.name_vi', 'ua.*')
            ->get();
    }

    public function getAllJoinDataWithAdmin()
    {
        return DB::table('tbl_user_accessary as ua')
            ->join('tbl_user as u', 'ua.user_id', '=', 'u.user_id')
            ->join('tbl_accessary as a', 'ua.accessary_id', '=', 'a.accessary_id')
            ->where('u.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('a.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->select('u.name as user', 'a.code', 'a.name_vi', 'ua.*')
            ->get();
    }

    public function getPrice($userAccessaryId)
    {
        return DB::table('tbl_user_accessary')
            ->where('user_accessary_id', '=', $userAccessaryId)
            ->get();
    }

    public function deleteMulti($ids)
    {
        DB::table('tbl_user_accessary')->whereIn('user_accessary_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
