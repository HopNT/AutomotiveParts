<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 10:37
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Parts;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\PartsRepository;
use Illuminate\Support\Facades\DB;

class PartsRepositoryImpl extends GenericRepositoryImpl implements PartsRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Parts::class;
    }

    public function getAllByActive($status)
    {
        return DB::table('tbl_parts as p')
            ->leftJoin('tbl_catalog_parts as cp', 'p.catalog_parts_id', '=', 'cp.catalog_parts_id')
            ->where('cp.status', '=', $status)
            ->select('cp.name as catalogPartsName', 'p.*')
            ->get(

            );
    }

    public function searchByText($text)
    {
        $listParts = DB::table('tbl_parts')
            ->where('status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('code', 'LIKE', '%'.$text.'%')
            ->orWhere('name', 'LIKE', '%'.$text.'%')
            ->get();
        return $listParts;
    }

    public function deleteMulti($ids)
    {
        DB::table('tbl_parts')->whereIn('parts_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
