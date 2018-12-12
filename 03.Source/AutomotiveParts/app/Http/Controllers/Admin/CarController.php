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
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarLinkRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use App\Http\Common\Repository\NationRepository;
use App\Http\Common\Repository\YearManufactureRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends BackendController
{

    protected $carBrandRepository;

    protected $catalogCarRepository;

    protected $carRepository;

    protected $nationRepository;

    protected $yearManufactureRepository;

    protected $accessaryRepository;

    protected $carLinkRepository;

    /**
     * CarController constructor.
     * @param $carBrandRepository
     * @param $catalogCarRepository
     * @param $carRepository
     */
    public function __construct(CarBrandRepository $carBrandRepository, CatalogCarRepository $catalogCarRepository,
                                CarRepository $carRepository, NationRepository $nationRepository,
                                YearManufactureRepository $yearManufactureRepository,
                                AccessaryRepository $accessaryRepository, CarLinkRepository $carLinkRepository)
    {
        $this->carBrandRepository = $carBrandRepository;
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carRepository = $carRepository;
        $this->nationRepository = $nationRepository;
        $this->yearManufactureRepository = $yearManufactureRepository;
        $this->accessaryRepository = $accessaryRepository;
        $this->carLinkRepository = $carLinkRepository;
    }

    public function create() {
        $listYear = $this->yearManufactureRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $carBrandList = $this->carBrandRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $nationList = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.add_update_car')
            ->with('data', null)
            ->with('carBrandList', $carBrandList)
            ->with('listNation', $nationList)
            ->with('listYear', $listYear)
            ->render();
        return $view;
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
                $this->carRepository->merge($request->car_id, $car);
            } else {
                $validator = Validator::make($car, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                $car = array_add($car, 'status', GlobalEnum::STATUS_ACTIVE);
                $this->carRepository->persist($car);
            }
        } catch (\Exception $e) {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        $listYear = $this->yearManufactureRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $carBrandList = $this->carBrandRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $nationList = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.add_update_car')
            ->with('data', null)
            ->with('carBrandList', $carBrandList)
            ->with('listNation', $nationList)
            ->with('listYear', $listYear)
            ->with('error', false)
            ->render();
        return $view;

    }

    public function getById(Request $request)
    {
        $carId = $request->id;
        $car = $this->carRepository->find($carId);
        if (!empty($car)) {
            $car->catalogCar->carBrand;
        }

        $listYear = $this->yearManufactureRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $carBrandList = $this->carBrandRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $nationList = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);

        $catalogCarList = null;
        if (!empty($car)) {
            $catalogCarList = $this->catalogCarRepository->getByCarBrand($car->catalogCar->carBrand->car_brand_id);
        }

        $view = view('admin.car_management.elements.add_update_car')
            ->with('data', $car)
            ->with('carBrandList', $carBrandList)
            ->with('listNation', $nationList)
            ->with('listYear', $listYear)
            ->with('catalogCarList', $catalogCarList)
            ->render();

        return $view;
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->carRepository->deleteMulti($ids);
            $this->carRepository->deleteCarCatalogParts($ids);
            $this->accessaryRepository->updateCar($ids);
            $this->carLinkRepository->deleteByCarId($ids);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List Car
        $listCar = $this->carRepository->getAll();
        $view = view('admin.car_management.elements.list_data_car')
            ->with('listCar', $listCar)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getByCatalog(Request $request) {
        $id = $request->id;
        return $this->carRepository->getByCatalog($id);
    }

    public function searchByText(Request $request) {
        $results = array();
        $text = $request->get('query');
        $listCar = $this->carRepository->searchByText($text);
        $index = 0;
        if (!empty($listCar))
        {
            foreach ($listCar as $key => $car)
            {
                $results[$index]['id'] = $car->car_id;
                $results[$index]['text'] = $car->name.($car->year ? ' - '.$car->year : '');
                $index++;
            }
        }
        return [
            'items' => $results
        ];
    }

}
