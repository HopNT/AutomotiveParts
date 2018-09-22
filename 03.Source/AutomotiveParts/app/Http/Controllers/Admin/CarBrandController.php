<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:53
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\CarBrand;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\NationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarBrandController extends BackendController
{

    protected $nationRepository;

    protected $carBrandRepository;

    /**
     * CarBrandController constructor.
     * @param CarBrandRepository $carBrandRepository
     * @param NationRepository $nationRepository
     */
    public function __construct(CarBrandRepository $carBrandRepository, NationRepository $nationRepository)
    {
        $this->carBrandRepository = $carBrandRepository;
        $this->nationRepository = $nationRepository;
    }

    public function getAll()
    {
        return $this->carBrandRepository->getAllWitActive(GlobalEnum::STATUS_ACTIVE);
    }

    public function save(Request $request)
    {
        $valid = new CarBrand();
        $carBrand = $request->all();
        try
        {
            if (isset($request->car_brand_id)) {
                $this->carBrandRepository->merge($request->car_brand_id, $carBrand);
            } else {
                $validator = Validator::make($request->all(), $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                $carBrand = array_add($carBrand, 'status', GlobalEnum::STATUS_ACTIVE);
                $this->carBrandRepository->persist($carBrand);
            }
        }
        catch(\Exception $e)
        {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }


        // Get List CarBrand
        $listCarBrand = $this->carBrandRepository->getAllWitActive(GlobalEnum::STATUS_ACTIVE);
        $listNation = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.list_data_car_brand')
            ->with('listCarBrand', $listCarBrand)
            ->with('listNation', $listNation)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getById(Request $request)
    {
        $carBrand = $this->carBrandRepository->find($request->id);
        return [
            'data' => $carBrand
        ];
    }

    public function deleteMulti(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->carBrandRepository->deleteMulti($ids);
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
        $listNation = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.car_management.elements.list_data_car_brand')
            ->with('listCarBrand', $listCarBrand)
            ->with('listNation', $listNation)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

}
