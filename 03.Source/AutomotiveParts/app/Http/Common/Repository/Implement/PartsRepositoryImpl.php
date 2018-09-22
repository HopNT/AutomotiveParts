<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 10:37
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Parts;
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

    function getAllByActive($status)
    {
        return DB::table('tbl_parts as p')
            ->leftJoin('tbl_catalog_parts as cp', 'p.catalog_parts_id', '=', 'cp.catalog_parts_id')
            ->where('p.status', '=', $status)
            ->where('cp.status', '=', $status)
            ->select('cp.name as catalogPartsName', 'p.*')
            ->get();
    }
}
