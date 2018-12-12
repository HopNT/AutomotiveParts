<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 16:16
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Nation;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\NationRepository;
use Illuminate\Support\Facades\DB;

class NationRepositoryImplement extends GenericRepositoryImpl implements NationRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Nation::class;
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function deleteMulti($ids) {
//        DB::table('tbl_nation')->whereIn('nation_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
        DB::table('tbl_nation')->whereIn('nation_id', $ids)->delete();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function findByCode($code) {
        return DB::table('tbl_nation')
            ->where('code', '=', $code)
            ->get();
    }
}
