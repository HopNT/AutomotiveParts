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
            ->delete();
    }

    public function searchByCode($query)
    {
        return DB::table('tbl_accessary as a')
            ->leftJoin('tbl_car_link as cl', 'a.accessary_id', '=', 'cl.accessary_id')
            ->leftJoin('tbl_car as c', 'cl.car_id', '=', 'c.car_id')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->leftJoin('tbl_nation as n', 'a.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_trademark as tr', 'a.trademark_id', '=', 'tr.trademark_id')
            ->whereIn('a.code', $query)
            ->select('a.*', 'n.name_vi as nation_name', 'tr.name as trademark_name', 'tr.description as trademark_desc')
            ->distinct()
            ->get();
    }

    public function searchByKeywordAndCarname($request){
        $keyword = isset($request->key_search) ? $request->key_search : '';
        $car_name = isset($request->car_name) ? $request->car_name : '';
        $data = DB::table('tbl_accessary as a')
            ->leftJoin('tbl_car_link as cl', 'a.accessary_id', '=', 'cl.accessary_id')
            ->leftJoin('tbl_car as c', 'cl.car_id', '=', 'c.car_id')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->leftJoin('tbl_nation as n', 'a.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_trademark as tr', 'a.trademark_id', '=', 'tr.trademark_id')
            ->select('a.*', 'n.name_vi as nation_name', 'tr.name as trademark_name', 'tr.description as trademark_desc');
            if($car_name){
                $data->whereRaw('c.name like \'%' . $car_name . '%\'');
            }
            if($keyword){
                $data->orWhere(function($data) use ($keyword){
                    $data->whereRaw('a.name_vi like \'%' . $keyword . '%\'')
                        ->orWhereRaw('a.acronym_name like \'%' . $keyword . '%\'')
                        ->orWhereRaw('a.unsigned_name like \'&' . $keyword .'&\'')
                        ->orWhereIn('a.code', '\''.$keyword.'\'');
                });
            }
        return $data->distinct()->get();
    }

    public function searchById($accessaryId)
    {
        return DB::table('tbl_accessary as a')
            ->leftJoin('tbl_nation as n', 'a.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_trademark as tr', 'a.trademark_id', '=', 'tr.trademark_id')
            ->where('a.accessary_id', '=', $accessaryId)
            ->select('a.*', 'n.name_vi as nation_name', 'tr.name as trademark_name', 'tr.description as trademark_desc')
            ->get();
    }

    public function loadByPartsId($arrayPartsId)
    {
        return DB::table('tbl_accessary as a')
            ->leftJoin('tbl_catalog_parts_accessary as cpa', 'a.accessary_id', '=', 'cpa.accessary_id')
            ->leftJoin('tbl_catalog_parts as cp', 'cp.catalog_parts_id', '=', 'cpa.catalog_parts_id')
            ->where('a.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('cp.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('cp.catalog_parts_id', '=', $arrayPartsId)
            ->distinct()
            ->select('a.*')
            ->get();
    }

    public function findCarUsed($accessaryId) {
        return DB::table('tbl_car as c')
            ->leftJoin('tbl_car_parts as cp', 'c.car_id', '=', 'cp.car_id')
            ->leftJoin('tbl_parts as p', 'cp.parts_id', '=', 'p.parts_id')
            ->leftJoin('tbl_parts_accessary as pa', 'p.parts_id', '=', 'pa.parts_id')
            ->leftJoin('tbl_accessary as a', 'pa.accessary_id', '=', 'a.accessary_id')
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->leftJoin('tbl_catalog_car as cc', 'c.catalog_car_id', '=', 'cc.catalog_car_id')
            ->leftJoin('tbl_car_brand as cb', 'cc.car_brand_id', '=', 'cb.car_brand_id')
            ->where('a.accessary_id', '=', $accessaryId)
            ->select('c.name', 'y.year', 'cc.name as catalogName', 'cb.name as carBrand')
            ->distinct()
            ->get();
    }

    public function searchByCar($carName, $year) {
        $condition = '';
        if (!empty($carName)) {
            $condition = $condition.' c.name LIKE ("%'.$carName.'%")';
        }
        if (!empty($year)) {
            if (!empty($condition)) {
                $condition = $condition.' AND ';
            }
            $condition = $condition.' y.code = '.$year;
        }

        return DB::table('tbl_accessary as a')
            ->leftJoin('tbl_car_link as cl', 'a.accessary_id', '=', 'cl.accessary_id')
            ->leftJoin('tbl_car as c', function ($join) {
                $join->on('c.car_id', '=', 'cl.car_id');
                $join->orOn('c.car_id', '=', 'a.car_id');
            })
            ->leftJoin('tbl_year_manufacture as y', 'c.year_manufacture_id', '=', 'y.year_manufacture_id')
            ->whereRaw('1 = 1')
            ->whereRaw($condition)
            ->select('a.*')
            ->distinct()
            ->get();

    }

    public function search($request) {

        $keyword = isset($request->key_search) ? $request->key_search : '';
        $car_name = isset($request->car_name) ? $request->car_name : '';

        $condition = '';

        if ($keyword) {
            $condition = $condition.' (a.code IN ('.$keyword.') OR a.name_en LIKE BINARY \'%' . $keyword . '%\' OR a.name_vi LIKE BINARY \'%' . $keyword . '%\' OR a.acronym_name LIKE BINARY \'%' . $keyword . '%\' OR a.unsigned_name LIKE  BINARY \'%' . $keyword . '%\') ';
        }

        if ($car_name) {
            if (!empty($condition)) {
                $condition = $condition.' AND ';
            }
            $condition = $condition.' c.name LIKE BINARY \'%' . $car_name . '%\' ';
        }

        return DB::table('tbl_accessary as a')
            ->leftJoin('tbl_car_link as cl', 'a.accessary_id', '=', 'cl.accessary_id')
            ->leftJoin('tbl_car as c', 'cl.car_id', '=', 'c.car_id')
            ->leftJoin('tbl_nation as n', 'a.nation_id', '=', 'n.nation_id')
            ->leftJoin('tbl_trademark as tr', 'a.trademark_id', '=', 'tr.trademark_id')
            ->whereRaw('1 = 1')
            ->whereRaw($condition)
            ->select('a.*', 'n.name_vi as nation_name', 'tr.name as trademark_name', 'tr.description as trademark_desc')
            ->distinct()
            ->get();

    }

    public function getAccessaryIdByCode($code) {
        return DB::table('tbl_accessary')
            ->whereIn('code', $code)
            ->where('status', '=', GlobalEnum::STATUS_ACTIVE)
            ->select('accessary_id')
            ->get();
    }

    public function updateNation($nationId) {
        DB::table('tbl_accessary')->whereIn('nation_id', $nationId)->update(['nation_id' => NULL]);
    }

    public function updateTradeMark($tradeMarkId) {
        DB::table('tbl_accessary')->whereIn('trademark_id', $tradeMarkId)->update(['trademark_id' => NULL]);
    }

    public function updateCar($carId) {
        DB::table('tbl_accessary')->whereIn('car_id', $carId)->update(['car_id' => NULL]);
    }

    public function deleteCatalogPartsAccessaary($accessaryId) {
        DB::table('tbl_catalog_parts_accessary')
            ->whereIn('accessary_id', $accessaryId)
            ->delete();
    }
}
