<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/13/2018
 * Time: 15:13
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;

class CarController extends BackendController {

    protected $carBrandRepository;

    protected $catalogCarRepository;

    protected $carRepository;

    /**
     * CarController constructor.
     * @param $carBrandRepository
     * @param $catalogCarRepository
     * @param $carRepository
     */
    public function __construct(CarBrandRepository $carBrandRepository, CatalogCarRepository $catalogCarRepository, CarRepository $carRepository)
    {
        $this->carBrandRepository = $carBrandRepository;
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carRepository = $carRepository;
    }

}
