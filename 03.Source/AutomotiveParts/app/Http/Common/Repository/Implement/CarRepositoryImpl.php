<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:57
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Accessary;
use App\Http\Common\Entities\Car;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarRepository;
use function foo\func;
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
        DB::table('tbl_car')->whereIn('car_id', $ids)->delete();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getByAccessary($code)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_car_link as cl', 'c.car_id', '=', 'cl.car_id')
            ->leftJoin('tbl_nation as n', 'c.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->whereIn('cl.accessary_id', $code)
            ->selectRaw('distinct c.*, y.year, n.name_vi')
            ->get();
    }

    public function getByAccessaryId($accessaryId)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_car_link as cl', 'c.car_id', '=', 'cl.car_id')
            ->leftJoin('tbl_nation as n', 'c.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->where('cl.accessary_id', '=', $accessaryId)
            ->selectRaw('distinct c.*, y.year, n.name_vi')
            ->get();
    }

    /**
     * @param $catalogCarId
     * @return mixed
     */
    public function getByCatalog($catalogCarId)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->where('c.catalog_car_id', '=', $catalogCarId)
            ->select('c.*', 'y.year')
            ->get();
    }

    /**
     * @param $text
     * @return mixed
     */
    public function searchByText($text)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->whereRaw("c.status = ".GlobalEnum::STATUS_ACTIVE." AND (c.code LIKE ('%".$text."%') OR c.name LIKE ('%".$text."%'))")
            ->select('c.*', 'y.year')
            ->get();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getCarIdByCode($code) {
        return DB::table('tbl_car')
            ->whereIn('code', $code)
            ->where('status', '=', GlobalEnum::STATUS_ACTIVE)
            ->select('car_id')
            ->get();
    }

    /**
     * @param $nationId
     * @return mixed
     */
    public function updateNation($nationId) {
        DB::table('tbl_car')->whereIn('nation_id', $nationId)->update(['nation_id' => NULL]);
    }

    /**
     * @param $carId
     * @return mixed
     */
    public function deleteCarCatalogParts($carId) {
        DB::table('tbl_car_catalog_parts')
            ->whereIn('car_id', $carId)
            ->delete();
    }
}
