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

    function deleteMulti($ids)
    {
        DB::table('tbl_catalog_parts')->whereIn('catalog_parts_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
