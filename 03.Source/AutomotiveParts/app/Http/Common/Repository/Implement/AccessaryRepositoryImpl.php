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

    function searchByText($text)
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
}
