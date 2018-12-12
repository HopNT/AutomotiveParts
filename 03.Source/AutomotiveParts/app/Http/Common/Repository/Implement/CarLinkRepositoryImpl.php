<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 11/25/2018
 * Time: 17:54
 */

namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\CarLink;
use App\Http\Common\Repository\CarLinkRepository;
use Illuminate\Support\Facades\DB;

class CarLinkRepositoryImpl extends GenericRepositoryImpl implements CarLinkRepository {
    /**
     * @return mixed
     */
    public function getModel()
    {
        return CarLink::class;
    }

    public function deleteAll($accessaryId) {
        DB::table('tbl_car_link')
            ->where('accessary_id', '=', $accessaryId)
            ->delete();
    }

    public function findByIdValue($key, $value) {
        return DB::table('tbl_car_link')
            ->where('accessary_id', '=', $key)
            ->where('car_id', '=', $value)
            ->get();
    }

    public function deleteByCarId($carId) {
        DB::table('tbl_car_link')
            ->whereIn('car_id', $carId)
            ->delete();
    }

    public function deleteByAccessaryId($accessaryId) {
        DB::table('tbl_car_link')
            ->whereIn('accessary_id', $accessaryId)
            ->delete();
    }
}
