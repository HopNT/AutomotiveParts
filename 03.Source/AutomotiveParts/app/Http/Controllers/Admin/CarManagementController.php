<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/06/2018
 * Time: 10:02
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use App\Http\Common\Repository\NationRepository;
use App\Http\Common\Repository\PartsRepository;

class CarManagementController extends BackendController
{

    protected $nationRepository;

    protected $carBrandRepository;

    protected $catalogCarRepository;

    protected $carRepository;

    protected $partsRepository;

    /**
     * CarManagementController constructor.
     * @param $nationRepository
     * @param $carBrandRepository
     * @param $catalogCarRepository
     * @param $carRepository
     * @param $partsRepository
     */
    public function __construct(NationRepository $nationRepository, CarBrandRepository $carBrandRepository, CatalogCarRepository $catalogCarRepository, CarRepository $carRepository, PartsRepository $partsRepository)
    {
        $this->nationRepository = $nationRepository;
        $this->carBrandRepository = $carBrandRepository;
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carRepository = $carRepository;
        $this->partsRepository = $partsRepository;
    }

    public function index()
    {
        $listYear = array();
        for ($i = 1970; $i <= 2019; $i++) {
            $obj = new \stdClass();
            $obj->key = $i;
            $obj->value = $i;
            array_push($listYear, $obj);
        }
//        dd($listYear);
        $listCarBrand = $this->carBrandRepository->getAllWitActive(GlobalEnum::STATUS_ACTIVE);
        $listCatalogCar = $this->catalogCarRepository->getAllWithActive(GlobalEnum::STATUS_ACTIVE);
        $listCar = $this->carRepository->getAllWithActive(GlobalEnum::STATUS_ACTIVE);
        $listNation = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $listParts = $this->partsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        return view('admin.car_management.car_management')
            ->with('listCarBrand', $listCarBrand)
            ->with('listCatalogCar', $listCatalogCar)
            ->with('listCar', $listCar)
            ->with('listNation', $listNation)
            ->with('listParts', $listParts)
            ->with('listYear', $listYear);
    }

}
