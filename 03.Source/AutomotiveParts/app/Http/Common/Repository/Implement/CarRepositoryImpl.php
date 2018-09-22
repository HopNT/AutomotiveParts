<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:57
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Car;
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
    function getAllWithActive($status)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_catalog_car as cc', 'c.catalog_car_id', '=', 'cc.catalog_car_id')
            ->leftJoin('tbl_car_brand as cb', 'cc.car_brand_id', '=', 'cb.car_brand_id')
            ->where('c.status', '=', $status)
            ->where('cc.status', '=', $status)
            ->where('cb.status', '=', $status)
            ->select('cb.name as carBrandName', 'cc.name as catalogCarName', 'c.*')
            ->get();
    }
}
