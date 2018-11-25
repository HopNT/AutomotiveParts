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

    /**
     * @param $code
     * @return mixed
     */
    public function getByAccessary($code)
    {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_car_parts as cp', 'c.car_id', '=', 'cp.car_id')
            ->leftJoin('tbl_parts as p', 'cp.parts_id', '=', 'p.parts_id')
            ->leftJoin('tbl_parts_accessary as pa', 'p.parts_id', '=', 'pa.parts_id')
            ->leftJoin('tbl_accessary as a', 'pa.accessary_id', '=', 'a.accessary_id')
            ->leftJoin('tbl_nation as n', 'c.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->whereIn('a.code', $code)
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
            ->where('c.name', 'LIKE', '%'.$text.'%')
            ->where('c.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->select('c.*', 'y.year')
            ->get();
    }
}
