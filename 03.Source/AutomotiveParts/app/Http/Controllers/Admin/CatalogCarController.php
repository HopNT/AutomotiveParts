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
use App\Http\Common\Repository\CatalogCarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatalogCarController extends BackendController
{

    protected $catalogCarRepository;

    protected $carBrandRepository;

    /**
     * CatalogCarController constructor.
     * @param $catalogCarRepository
     * @param $carBrandRepository
     */
    public function __construct(CatalogCarRepository $catalogCarRepository, CarBrandRepository $carBrandRepository)
    {
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carBrandRepository = $carBrandRepository;
    }

    public function save(Request $request)
    {
        $valid = new CatalogCar();
        $catalogCar = $request->all();
        try
        {
            if (isset($request->catalog_car_id)) {
                $this->catalogCarRepository->merge($request->catalog_car_id, $catalogCar);
            } else {
                $validator = Validator::make($request->all(), $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
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

        // Get List CarBrand
        $listCatalogCar = $this->catalogCarRepository->getAllWithActive(GlobalEnum::STATUS_ACTIVE);
        $listCarBrand = $this->carBrandRepository->getAllWitActive(GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.list_data_catalog_car')
              ->with('listCatalogCar', $listCatalogCar)
              ->with('listCarBrand', $listCarBrand)->render();
        return [
            'error' => false,
            'html' => $view
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

        // Get List CarBrand
        $listCarBrand = $this->carBrandRepository->getAllWitActive(GlobalEnum::STATUS_ACTIVE);
        $listCatalogCar = $this->catalogCarRepository->getAllWithActive(GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.list_data_catalog_car')
            ->with('listCarBrand', $listCarBrand)
            ->with('listCatalogCar', $listCatalogCar)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getByCarBrand(Request $request)
    {
        $carBrandId = $request->id;
        $carBrand = $this->carBrandRepository->find($carBrandId);
        $catalogCar = $carBrand->catalogCars;
        return $catalogCar;
    }
}
