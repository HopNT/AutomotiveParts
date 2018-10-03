<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/03/2018
 * Time: 10:04
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\TempPrice;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\TempPriceRepository;
use Illuminate\Support\Facades\DB;

class TempPriceRepositoryImpl extends GenericRepositoryImpl implements TempPriceRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return TempPrice::class;
    }

    function getAllByAdmin()
    {
        return DB::table('tbl_temp_price as t')
            ->join('tbl_user as u', 't.user_id', '=', 'u.user_id')
            ->where('t.status', '=', GlobalEnum::STATUS_PENDING)
            ->where('u.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->select('u.name as user', 't.*')
            ->get();
    }

    function getAllByProductProvider($userId)
    {
        return DB::table('tbl_temp_price as t')
            ->join('tbl_user as u', 't.user_id', '=', 'u.user_id')
            ->where('u.status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('t.user_id', '=', $userId)
            ->select('u.name as user', 't.*')
            ->get();
    }
}
