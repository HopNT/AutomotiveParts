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
    function getAllWithActive($status)
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
    function deleteMulti($ids)
    {
        DB::table('tbl_catalog_car')->whereIn('catalog_car_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
