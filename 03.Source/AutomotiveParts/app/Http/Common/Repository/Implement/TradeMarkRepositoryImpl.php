<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/19/2018
 * Time: 09:10
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\TradeMark;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\TradeMarkRepository;
use Illuminate\Support\Facades\DB;

class TradeMarkRepositoryImpl extends GenericRepositoryImpl implements TradeMarkRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return TradeMark::class;
    }

    function deleteMulti($ids)
    {
        DB::table('tbl_trademark')->whereIn('trademark_id', $ids)->update(['status'=>GlobalEnum::STATUS_INACTIVE, 'updated_at'=>now()]);
    }
}
