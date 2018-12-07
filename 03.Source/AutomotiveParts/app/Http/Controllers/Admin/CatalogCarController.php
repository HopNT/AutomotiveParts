<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/10/2018
 * Time: 10:58
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\CatalogCar;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatalogCarController extends BackendController
{

    protected $catalogCarRepository;

    protected $carBrandRepository;

    protected $carRepository;

    /**
     * CatalogCarController constructor.
     * @param $catalogCarRepository
     * @param $carBrandRepository
     */
    public function __construct(CatalogCarRepository $catalogCarRepository, CarBrandRepository $carBrandRepository, CarRepository $carRepository)
    {
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carBrandRepository = $carBrandRepository;
        $this->carRepository = $carRepository;
    }

    public function save(Request $request)
    {
        $valid = new CatalogCar();
        $catalogCar = $request->all();
        try
        {
            $validator = Validator::make($request->all(), $valid->rules, [], $valid->attributes);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }
            if (isset($request->catalog_car_id)) {
                $this->catalogCarRepository->merge($request->catalog_car_id, $catalogCar);
            } else {
                $catalogCar = array_add($catalogCar, 'status', GlobalEnum::STATUS_ACTIVE);
                $this->catalogCarRepository->persist($catalogCar);
            }
        }
        catch (\Exception $e)
        {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        $listCatalogCar = $this->catalogCarRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $listCar = $this->carRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $viewCatalogCar = view('admin.car_management.elements.list_data_catalog_car')
            ->with('listCatalogCar', $listCatalogCar)->render();
        $viewCar = view('admin.car_management.elements.list_data_car')
            ->with('listCar', $listCar)->render();
        return [
            'error' => false,
            'catalogCar' => $viewCatalogCar,
            'car' => $viewCar
        ];
    }

    public function getById(Request $request)
    {
        $catalogCar = $this->catalogCarRepository->find($request->id);
        return [
            'data' => $catalogCar
        ];
    }

    public function deleteMulti(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->catalogCarRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        $listCatalogCar = $this->catalogCarRepository->getAll();
        $listCar = $this->carRepository->getAll();
        $viewCatalogCar = view('admin.car_management.elements.list_data_catalog_car')
            ->with('listCatalogCar', $listCatalogCar)->render();
        $viewCar = view('admin.car_management.elements.list_data_car')
            ->with('listCar', $listCar)->render();
        return [
            'error' => false,
            'catalogCar' => $viewCatalogCar,
            'car' => $viewCar
        ];
    }

    public function getByCarBrand(Request $request)
    {
        $carBrandId = $request->id;
        $carBrand = $this->carBrandRepository->find($carBrandId);
        $catalogCar = $carBrand->catalogCars;
        return $catalogCar;
    }

    public function getAll()
    {
        return $this->catalogCarRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }
}
