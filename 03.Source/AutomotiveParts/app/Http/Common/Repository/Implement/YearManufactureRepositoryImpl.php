<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/24/2018
 * Time: 12:22
 */

namespace App\Http\Common\Repository\Implement;
use App\Http\Common\Entities\YearManufacture;
use App\Http\Common\Repository\YearManufactureRepository;

class YearManufactureRepositoryImpl extends GenericRepositoryImpl implements YearManufactureRepository {
    /**
     * @return mixed
     */
    public function getModel()
    {
        return YearManufacture::class;
    }
}
