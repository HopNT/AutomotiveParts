<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/23/2018
 * Time: 17:48
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Accessary;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\AccessaryRepository;
use Illuminate\Support\Facades\DB;

class AccessaryRepositoryImpl extends GenericRepositoryImpl implements AccessaryRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Accessary::class;
    }

    public function searchByText($text)
    {
        $listAccessary = DB::table('tbl_accessary')
            ->where('status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('code', 'LIKE', '%'.$text.'%')
            ->orWhere('name_en', 'LIKE', '%'.$text.'%')
            ->orWhere('name_vi', 'LIKE', '%'.$text.'%')
            ->orWhere('acronym_name', 'LIKE', '%'.$text.'%')
            ->orWhere('unsigned_name', 'LIKE', '%'.$text.'%')
            ->get();
        return $listAccessary;
    }

    public function findByCode($code)
    {
        return DB::table('tbl_accessary')
            ->where('code', '=', $code)
            ->where('status', '=', GlobalEnum::STATUS_ACTIVE)
            ->get();
    }

    public function deleteMulti($ids) {
        DB::table('tbl_accessary')
            ->whereIn('accessary_id', $ids)
            ->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }

    public function searchByMinCost($query)
    {
        return DB::table('tbl_accessary as a')
            ->join('tbl_nation as n', 'a.nation_id', '=', 'n.nation_id')
            ->join('tbl_trademark as tr', 'a.trademark_id', '=', 'tr.trademark_id')
            ->join('tbl_user_accessary as ua', 'a.accessary_id', '=', 'ua.accessary_id')
            ->join('tbl_user as u', 'ua.user_id', '=', 'u.user_id')
            ->where('a.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('u.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('ua.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->whereIn('a.code', $query)
            ->groupBy('a.code')
            ->selectRaw('a.*, n.name_vi as nation_name, n.description as nation_desc, tr.name as trademark_name, tr.description as trademark_desc, u.*, ua.garage_price, min(ua.retail_price) as retail_price_min, ua.quantity')
            ->get();
    }
}
