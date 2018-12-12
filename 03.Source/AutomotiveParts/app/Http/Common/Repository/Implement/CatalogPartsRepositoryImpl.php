<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 10:35
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\CatalogParts;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CatalogPartsRepository;
use function foo\func;
use Illuminate\Support\Facades\DB;

class CatalogPartsRepositoryImpl extends GenericRepositoryImpl implements CatalogPartsRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return CatalogParts::class;
    }

    public function deleteMulti($ids)
    {
        DB::table('tbl_catalog_parts')
            ->whereNotNull('parent_id')
            ->whereIn('catalog_parts_id', $ids)
            ->delete();
    }

    public function searchByText($text)
    {
        $listParts = DB::table('tbl_catalog_parts')
            ->whereRaw("status = ".GlobalEnum::STATUS_ACTIVE." AND parent_id IS NOT NULL AND (code LIKE ('%".$text."%') OR name LIKE ('%".$text."%'))")
            ->get();
        return $listParts;
    }

    public function searchByTextParent($text)
    {
        $listParts = DB::table('tbl_catalog_parts')
            ->whereRaw("status = ".GlobalEnum::STATUS_ACTIVE." AND parent_id IS NULL AND (code LIKE ('%".$text."%') OR name LIKE ('%".$text."%'))")
            ->get();
        return $listParts;
    }

    public function getCatalogPartsIdByCode($code) {
        return DB::table('tbl_catalog_parts')
            ->whereIn('code', $code)
            ->select('catalog_parts_id')
            ->get();
    }

    public function deleteCarCatalogParts($catalogPartsId) {
        DB::table('tbl_car_catalog_parts')
            ->whereIn('catalog_parts_id', $catalogPartsId)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('tbl_catalog_parts')
                    ->whereRaw('tbl_catalog_parts.catalog_parts_id = tbl_car_catalog_parts.catalog_parts_id');
            })
            ->delete();
    }

    public function deleteCatalogPartsAccessary($catalogPartsId) {
        DB::table('tbl_catalog_parts_accessary')
            ->whereIn('catalog_parts_id', $catalogPartsId)
            ->whereNotExists(function($query) {
                $query->select(DB::raw(1))
                    ->from('tbl_catalog_parts')
                    ->whereRaw('tbl_catalog_parts.catalog_parts_id = tbl_catalog_parts_accessary.catalog_parts_id');
            })
            ->delete();
    }
}
