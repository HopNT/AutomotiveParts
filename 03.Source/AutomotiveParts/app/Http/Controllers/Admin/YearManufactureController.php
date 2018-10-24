<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/24/2018
 * Time: 12:24
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\YearManufactureRepository;

class YearManufactureController {

    protected $yearManufactureRepository;

    /**
     * YearManufactureController constructor.
     * @param $yearManufactureRepository
     */
    public function __construct(YearManufactureRepository $yearManufactureRepository)
    {
        $this->yearManufactureRepository = $yearManufactureRepository;
    }

    public function getAll() {
        return $this->yearManufactureRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }

}
