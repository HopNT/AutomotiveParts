<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:55
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\CatalogCar;
use App\Http\Common\Repository\CatalogCarRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Common\Enum\GlobalEnum;

class CatalogCarRepositoryImpl extends GenericRepositoryImpl implements CatalogCarRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CatalogCar::class;
    }

    /**
     * @param $status
     * @return mixed
     */
    public function getAllWithActive($status)
    {
        return DB::table('tbl_catalog_car as cc')
            ->leftJoin('tbl_car_brand as cb', 'cc.car_brand_id', '=', 'cb.car_brand_id')
            ->where('cb.status', '=', $status)
            ->select('cb.name as carBrandName', 'cc.*')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function deleteMulti($ids)
    {
        DB::table('tbl_catalog_car')
            ->whereIn('catalog_car_id', $ids)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('tbl_car')
                    ->whereRaw('tbl_car.catalog_car_id = tbl_catalog_car.catalog_car_id');
            })
            ->delete();
    }

    /**
     * @param $carBrandId
     * @return mixed
     */
    public function getByCarBrand($carBrandId)
    {
        return DB::table('tbl_catalog_car')
            ->where('car_brand_id', '=', $carBrandId)
            ->get();
    }
}
