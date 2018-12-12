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


    public function getAllWitActive($status) {
        return DB::table('tbl_car_brand as cb')
            ->leftJoin('tbl_nation as n', function ($join) {
                $join->on('cb.nation_id', '=', 'n.nation_id');
                $join->where('n.status', '=', GlobalEnum::STATUS_ACTIVE);
            })
            ->select('cb.car_brand_id', 'cb.code', 'cb.code_brand', 'cb.name', 'cb.status', 'n.name_vi')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function deleteMulti($ids) {
        DB::table('tbl_car_brand')
            ->whereIn('car_brand_id', $ids)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('tbl_catalog_car')
                    ->whereRaw('tbl_catalog_car.car_brand_id = tbl_car_brand.car_brand_id');
            })
            ->delete();
    }

    /**
     * @param $nationId
     * @return mixed
     */
    public function updateNation($nationId) {
        DB::table('tbl_car_brand')->whereIn('nation_id', $nationId)->update(['nation_id' => NULL]);
    }
}
