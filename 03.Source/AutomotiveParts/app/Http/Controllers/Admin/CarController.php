<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/13/2018
 * Time: 15:13
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\Car;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends BackendController
{

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

    public function save(Request $request)
    {
        $valid = new Car();
        $car = $request->all();
        if ($request->has('parts')) {
            $parts = $car['parts'];
        }

        try {
            if (isset($request->car_id)) {
                $car = $this->carRepository->merge($request->car_id, $car);
                if (!empty($parts)) {
                    $car->parts()->sync($parts);
                } else {
                    $car->parts()->detach();
                }
            } else {
                $validator = Validator::make($car, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                $car = array_add($car, 'status', GlobalEnum::STATUS_ACTIVE);
                $car = $this->carRepository->persist($car);
                if (!empty($parts)) {
                    $car->parts()->attach($parts);
                }
            }
        } catch (\Exception $e) {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }


        // Get List CarBrand
        $listCar = $this->carRepository->getAllWithActive(GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.list_data_car')
            ->with('listCar', $listCar)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getById(Request $request)
    {
        $carId = $request->id;
        $car = $this->carRepository->find($carId);
        if (!empty($car)) {
            $car->parts->find($carId);
            $car->catalogCar->carBrand;
            $car->parts;
        }
        return [
            'data' => $car
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->carRepository->deleteMulti($ids);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List Car
        $listCar = $this->carRepository->getAllWithActive(GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.list_data_car')
            ->with('listCar', $listCar)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

}
