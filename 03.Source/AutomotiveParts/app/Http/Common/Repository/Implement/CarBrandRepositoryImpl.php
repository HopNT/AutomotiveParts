<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/06/2018
 * Time: 16:10
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\CarBrand;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarBrandRepository;
use Illuminate\Support\Facades\DB;

class CarBrandRepositoryImpl extends GenericRepositoryImpl implements CarBrandRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CarBrand::class;
    }


    function getAllWitActive($status)
    {
        return DB::table('tbl_car_brand as cb')
            ->leftJoin('tbl_nation as n', function ($join) {
                $join->on('cb.nation_id', '=', 'n.nation_id');
                $join->where('n.status', '=', GlobalEnum::STATUS_ACTIVE);
            })
            ->where('cb.status', '=', $status)
            ->select('cb.car_brand_id', 'cb.code', 'cb.code_brand', 'cb.name', 'cb.status', 'n.name_vi')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    function deleteMulti($ids)
    {
        DB::table('tbl_car_brand')->whereIn('car_brand_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
