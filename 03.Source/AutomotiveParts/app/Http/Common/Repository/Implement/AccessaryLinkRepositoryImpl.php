<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/11/2018
 * Time: 10:22
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\AccessaryLink;
use App\Http\Common\Repository\AccessaryLinkRepository;
use Illuminate\Support\Facades\DB;

class AccessaryLinkRepositoryImpl extends GenericRepositoryImpl implements AccessaryLinkRepository {

    /**
     * @return mixed
     */
    public function getModel()
    {
        return AccessaryLink::class;
    }
    public function deleteAll($accessaryId)
    {
        DB::table('tbl_accessary_link')
            ->where('accessary_id', '=', $accessaryId)
            ->delete();
    }

    public function getAccessaryLinks($accessaryId)
    {
        return DB::table('tbl_accessary_link as a')
            ->where('a.accessary_id', '=', $accessaryId)
            ->get();
    }

    public function findByIdValue($key, $value) {
        return DB::table('tbl_accessary_link')
            ->where('accessary_id', '=', $key)
            ->where('accessary_value', '=', $value)
            ->get();
    }

    public function deleteByAccessaryId($accessaryId) {
        DB::table('tbl_accessary_link')
            ->whereIn('accessary_id', $accessaryId)
            ->delete();
    }
}
