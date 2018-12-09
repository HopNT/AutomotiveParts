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
        DB::table('tbl_catalog_parts')->whereIn('catalog_parts_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
        foreach ($ids as $id) {
            $exists = DB::table('tbl_catalog_parts')
                ->where('parent_id', '=', $id)
                ->get()->toArray();
            if (!empty($exists)) {
                $exists = array_add($exists, 'status', GlobalEnum::STATUS_INACTIVE);
                $this->merge($exists[0]->catalog_parts_id, $exists);
            }
        }
    }

    public function searchByText($text)
    {
        $listParts = DB::table('tbl_catalog_parts')
            ->whereRaw("status = ".GlobalEnum::STATUS_ACTIVE." AND parent_id IS NOT NULL AND (code LIKE ('%".$text."%') OR name LIKE ('%".$text."%'))")
            ->get();
        return $listParts;
    }

    public function getCatalogPartsIdByCode($code) {
        return DB::table('tbl_catalog_parts')
            ->whereIn('code', $code)
            ->select('catalog_parts_id')
            ->get();
    }
}
