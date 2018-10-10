<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:57
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Car;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarRepository;
use Illuminate\Support\Facades\DB;

class CarRepositoryImpl extends GenericRepositoryImpl implements CarRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Car::class;
    }

    /**
     * @param $status
     * @return mixed
     */
    public function getAllWithActive($status)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_catalog_car as cc', 'c.catalog_car_id', '=', 'cc.catalog_car_id')
            ->leftJoin('tbl_car_brand as cb', 'cc.car_brand_id', '=', 'cb.car_brand_id')
            ->where('cc.status', '=', $status)
            ->where('cb.status', '=', $status)
            ->select('cb.name as carBrandName', 'cc.name as catalogCarName', 'c.*')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function deleteMulti($ids)
    {
        DB::table('tbl_car')->whereIn('car_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
