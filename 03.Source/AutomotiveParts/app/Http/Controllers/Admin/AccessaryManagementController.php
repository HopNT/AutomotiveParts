<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/25/2018
 * Time: 01:51
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\Accessary;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Imports\AccessaryImport;
use App\Http\Common\Repository\AccessaryLinkRepository;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarLinkRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\NationRepository;
use App\Http\Common\Repository\PartsRepository;
use App\Http\Common\Repository\TradeMarkRepository;
use App\Http\Common\Utils\CommonUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccessaryManagementController extends BackendController
{
    protected $accessaryRepository;

    protected $accessaryLinkRepository;

    protected $nationRepository;

    protected $tradeMarkRepository;

    protected $carBrandRepository;

    protected $partsRepository;

    protected $carRepository;

    protected $catalogCarRepository;

    protected $carLinkRepository;

    protected $catalogPartsRepository;

    /**
     * AccessaryManagementController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository, AccessaryLinkRepository $accessaryLinkRepository,
                                NationRepository $nationRepository, TradeMarkRepository $tradeMarkRepository,
                                CarBrandRepository $carBrandRepository, PartsRepository $partsRepository,
                                CarRepository $carRepository, CatalogCarRepository $catalogCarRepository,
                                CarLinkRepository $carLinkRepository, CatalogPartsRepository $catalogPartsRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
        $this->accessaryLinkRepository = $accessaryLinkRepository;
        $this->nationRepository = $nationRepository;
        $this->tradeMarkRepository = $tradeMarkRepository;
        $this->carBrandRepository = $carBrandRepository;
        $this->partsRepository = $partsRepository;
        $this->carRepository = $carRepository;
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carLinkRepository = $carLinkRepository;
        $this->catalogPartsRepository = $catalogPartsRepository;
    }

    public function index()
    {
        $listAccessary = $this->accessaryRepository->getAll();
        foreach ($listAccessary as $accessary) {
            $car = $this->carRepository->find($accessary->car_id);
            if (!empty($car)) {
                $catalogCar = $car->catalogCar;
                $carBrand = $car->catalogCar->carBrand;
                $accessary->carBrandName = $carBrand->name;
                $accessary->catalogCarName = $catalogCar->name;
                $accessary->carName = $car->name;
                $accessary->year = $car->yearManufacture ? $car->yearManufacture->year : '';
            } else {
                $accessary->carBrandName = "";
                $accessary->catalogCarName = "";
                $accessary->carName = "";
                $accessary->year = "";
            }
        }

        return view('admin.accessary_management.accessary_management')
            ->with('listAccessary', $listAccessary);
    }

    public function createNew() {
        $carBrandList = $this->carBrandRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $partsList = $this->partsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $nationList = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $tradeMarkList = $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.accessary_management.elements.add_update_accessary')
            ->with('car', null)
            ->with('data', null)
            ->with('list', null)
            ->with('carBrandList', $carBrandList)
            ->with('partsList', $partsList)
            ->with('listNation', $nationList)
            ->with('tradeMarkList', $tradeMarkList)
            ->with('carUsed', null)
            ->with('partsAccessary', null)
            ->render();
        return $view;
    }

    public function getById(Request $request)
    {
        $accessaryList = array();
        $accessary = $this->accessaryRepository->find($request->id);
        foreach ($accessary->accessaryLinks as $key => $item) {
            $accessaryLink = $this->accessaryRepository->find($item->accessary_value);
            if ($accessaryLink) {
                $accessaryList[$key] = $accessaryLink;
            }
        }

        $carUsed = array();
        foreach ($accessary->carLinks as $key => $item) {
            $temp = $this->carRepository->find($item->car_id);
            if ($temp) {
                $carUsed[$key] = $temp;
            }
        }

        $nationList = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $tradeMarkList = $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $car = $this->carRepository->find($accessary->car_id);
        $carBrandList = $this->carBrandRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $partsList = $this->catalogPartsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $catalogCarList = null;
        $carList = null;
        if (!empty($car)) {
            $catalogCarList = $this->catalogCarRepository->getByCarBrand($car->catalogCar->carBrand->car_brand_id);
            $carList = $this->carRepository->getByCatalog($car->catalogCar->catalog_car_id);
        }

        $partsAccessary = $accessary->catalogParts;

        $view = view('admin.accessary_management.elements.add_update_accessary')
            ->with('car', $car)
            ->with('data', $accessary)
            ->with('list', $accessaryList)
            ->with('listNation', $nationList)
            ->with('tradeMarkList', $tradeMarkList)
            ->with('carBrandList', $carBrandList)
            ->with('partsList', $partsList)
            ->with('catalogCarList', $catalogCarList)
            ->with('carList', $carList)
            ->with('carUsed', $carUsed)
            ->with('partsAccessary', $partsAccessary)
            ->render();

        return $view;
    }

    public function save(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $valid = new Accessary();
        $accessary = $request->all();

        try {

            unset($accessary['photo_top']);
            unset($accessary['photo_bottom']);
            unset($accessary['photo_left']);
            unset($accessary['photo_right']);
            unset($accessary['photo_inner']);
            unset($accessary['photo_outer']);

            // Update
            if (isset($request->accessary_id)) {
                $exists = $this->accessaryRepository->find($request->accessary_id);
                if ($request->hasFile('photo_top')) {
                    if (!empty($exists->photo_top)) {
                        CommonUtils::deleteFile($exists->photo_top);
                    }
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_top', $pathPhotoTop);
                    $accessary = array_add($accessary, 'photo_top_name', $request->photo_top->getClientOriginalName());
                } else {
                    // If photo_top_check null then remove accessary photo_top
                    if (empty($request->photo_top_check)) {
                        if (!empty($exists->photo_top)) {
                            CommonUtils::deleteFile($exists->photo_top);
                        }
                        $accessary = array_add($accessary, 'photo_top', null);
                        $accessary = array_add($accessary, 'photo_top_name', null);
                        unset($accessary['photo_top_check']);
                    }
                }

                if ($request->hasFile('photo_bottom')) {
                    if (!empty($exists->photo_bottom)) {
                        CommonUtils::deleteFile($exists->photo_bottom);
                    }
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_bottom', $pathPhotoBottom);
                    $accessary = array_add($accessary, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                } else {
                    // If photo_bottom_check null then remove accessary photo_bottom
                    if (empty($request->photo_bottom_check)) {
                        if (!empty($exists->photo_bottom)) {
                            CommonUtils::deleteFile($exists->photo_bottom);
                        }
                        $accessary = array_add($accessary, 'photo_bottom', null);
                        $accessary = array_add($accessary, 'photo_bottom_name', null);
                        unset($accessary['photo_bottom_check']);
                    }
                }

                if ($request->hasFile('photo_left')) {
                    if (!empty($exists->photo_left)) {
                        CommonUtils::deleteFile($exists->photo_left);
                    }
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_left', $pathPhotoLeft);
                    $accessary = array_add($accessary, 'photo_left_name', $request->photo_left->getClientOriginalName());
                } else {
                    // If photo_left_check null then remove accessary photo_left
                    if (empty($request->photo_left_check)) {
                        if (!empty($exists->photo_left)) {
                            CommonUtils::deleteFile($exists->photo_left);
                        }
                        $accessary = array_add($accessary, 'photo_left', null);
                        $accessary = array_add($accessary, 'photo_left_name', null);
                        unset($accessary['photo_left_check']);
                    }
                }

                if ($request->hasFile('photo_right')) {
                    if (!empty($exists->photo_right)) {
                        CommonUtils::deleteFile($exists->photo_right);
                    }
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_right', $pathPhotoRight);
                    $accessary = array_add($accessary, 'photo_right_name', $request->photo_right->getClientOriginalName());
                } else {
                    // If photo_right_check null then remove accessary photo_right
                    if (empty($request->photo_right_check)) {
                        if (!empty($exists->photo_right)) {
                            CommonUtils::deleteFile($exists->photo_right);
                        }
                        $accessary = array_add($accessary, 'photo_right', null);
                        $accessary = array_add($accessary, 'photo_right_name', null);
                        unset($accessary->photo_right_check);
                    }
                }

                if ($request->hasFile('photo_inner')) {
                    if (!empty($exists->photo_inner)) {
                        CommonUtils::deleteFile($exists->photo_inner);
                    }
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_inner', $pathPhotoInner);
                    $accessary = array_add($accessary, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                } else {
                    // If photo_inner_check null then remove accessary photo_inner
                    if (empty($request->photo_inner_check)) {
                        if (!empty($exists->photo_inner)) {
                            CommonUtils::deleteFile($exists->photo_inner);
                        }
                        $accessary = array_add($accessary, 'photo_inner', null);
                        $accessary = array_add($accessary, 'photo_inner_name', null);
                        unset($accessary['photo_inner_check']);
                    }
                }

                if ($request->hasFile('photo_outer')) {
                    if (!empty($exists->photo_outer)) {
                        CommonUtils::deleteFile($exists->photo_outer);
                    }
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_outer', $pathPhotoOuter);
                    $accessary = array_add($accessary, 'photo_outer_name', $request->photo_outer->getClientOriginalName());
                } else {
                    // If photo_outer_check null then remove accessary photo_outer
                    if (empty($request->photo_outer_check)) {
                        if (!empty($exists->photo_outer)) {
                            CommonUtils::deleteFile($exists->photo_outer);
                        }
                        $accessary = array_add($accessary, 'photo_outer', null);
                        $accessary = array_add($accessary, 'photo_outer_name', null);
                        unset($accessary['photo_outer_check']);
                    }
                }

                $accessary = $this->accessaryRepository->merge($request->accessary_id, $accessary);

                if ($request->has('accessary_link')) {
                    $this->accessaryLinkRepository->deleteAll($request->accessary_id);
                    foreach ($request->accessary_link as $code) {
                        $check = $this->accessaryRepository->findByCode($code);
                        if (count($check)) {
                            $accessaryLink = [
                                'accessary_id' => $accessary['accessary_id'],
                                'accessary_value' => $check[0]->accessary_id
                            ];
                            $this->accessaryLinkRepository->persist($accessaryLink);
                        }
                    }
                } else {
                    $this->accessaryLinkRepository->deleteAll($request->accessary_id);
                }

                $this->carLinkRepository->deleteAll($request->accessary_id);
                if ($request->has('car_used')) {
                    foreach ($request->car_used as $item) {
                        $carLink = [
                            'accessary_id' => $accessary['accessary_id'],
                            'car_id' => $item
                        ];
                        $this->carLinkRepository->persist($carLink);
                        $newCarUsed = $this->carRepository->find($item);
                        if (!empty($request->parts)) {
                            $newCarUsed->catalogParts()->sync($request->parts);
                        }
                    }
                }

                if (!empty($request->parts)) {
                    $accessary->catalogParts()->sync($request->parts);
                } else {
                    $accessary->catalogParts()->detach();
                }

                $car = $this->carRepository->find($accessary['car_id']);
                if ($car && !empty($request->parts)) {
                    $car->catalogParts()->sync($request->parts);
                }

            } else {
                $validator = Validator::make($accessary, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }

                if ($request->hasFile('photo_top')) {
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_top', $pathPhotoTop);
                    $accessary = array_add($accessary, 'photo_top_name', $request->photo_top->getClientOriginalName());
                }

                if ($request->hasFile('photo_bottom')) {
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_bottom', $pathPhotoBottom);
                    $accessary = array_add($accessary, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                }

                if ($request->hasFile('photo_left')) {
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_left', $pathPhotoLeft);
                    $accessary = array_add($accessary, 'photo_left_name', $request->photo_left->getClientOriginalName());
                }

                if ($request->hasFile('photo_right')) {
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_right', $pathPhotoRight);
                    $accessary = array_add($accessary, 'photo_right_name', $request->photo_right->getClientOriginalName());
                }

                if ($request->hasFile('photo_inner')) {
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_inner', $pathPhotoInner);
                    $accessary = array_add($accessary, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                }

                if ($request->hasFile('photo_outer')) {
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $accessary = array_add($accessary, 'photo_outer', $pathPhotoOuter);
                    $accessary = array_add($accessary, 'photo_outer_name', $request->photo_outer->getClientOriginalName());
                }

                $accessary = array_add($accessary, 'status', GlobalEnum::STATUS_ACTIVE);
                $accessary = $this->accessaryRepository->persist($accessary);

                if ($request->has('accessary_link')) {
                    foreach ($request->accessary_link as $code) {
                        $check = $this->accessaryRepository->findByCode($code);
                        if (count($check) > 0) {
                            $accessaryLink = [
                                'accessary_id' => $accessary['accessary_id'],
                                'accessary_value' => $check[0]->accessary_id
                            ];
                            $this->accessaryLinkRepository->persist($accessaryLink);
                        }
                    }
                }

                if ($request->has('car_used')) {
                    foreach ($request->car_used as $item) {
                        $carLink = [
                            'accessary_id' => $accessary['accessary_id'],
                            'car_id' => $item
                        ];
                        $this->carLinkRepository->persist($carLink);
                        $newCarUsed = $this->carRepository->find($item);
                        if (!empty($request->parts)) {
                            $newCarUsed->catalogParts()->sync($request->parts);
                        }
                    }
                }

                if (!empty($request->parts)) {
                    $accessary->catalogParts()->attach($request->parts);
                }

                $car = $this->carRepository->find($accessary['car_id']);
                if ($car && !empty($request->parts)) {
                    $car->catalogParts()->sync($request->parts);
                }
            }
        } catch (\Exception $e) {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        // Get List accessary
        $listAccessary = $this->accessaryRepository->getAll();
        $view = view('admin.accessary_management.accessary_management')
            ->with('listAccessary', $listAccessary)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->accessaryRepository->deleteMulti($ids);
            $this->accessaryRepository->deleteCatalogPartsAccessaary($ids);
            $this->accessaryLinkRepository->deleteByAccessaryId($ids);
            $this->carLinkRepository->deleteByAccessaryId($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List accessary
        $listAccessary = $this->accessaryRepository->getAll();
        $view = view('admin.accessary_management.elements.list_data_accessary')
            ->with('listAccessary', $listAccessary)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function searchByText(Request $request)
    {
        $result = array();
        $text = $request->get('query');
        $listAccessary = $this->accessaryRepository->searchByText($text);
        $index = 0;
        if (!empty($listAccessary)) {
            foreach ($listAccessary as $item) {
                $result[$index]['id'] = $item->accessary_id;
                $result[$index]['text'] = $item->code . ' - ' . $item->name_vi;
                $index++;
            }
        }
        return [
            'items' => $result
        ];
    }

    public function searchByTextLimited(Request $request)
    {
        $result = array();
        $text = $request->get('query');
        $listAccessary = $this->accessaryRepository->searchByText($text);
        $index = 0;
        if (!empty($listAccessary)) {
            foreach ($listAccessary as $item) {
                if ($item->type !== null && $item->type !== '') {
                    $result[$index]['id'] = $item->accessary_id;
                    $result[$index]['text'] = $item->code . ' - ' . $item->name_vi;
                    $index++;
                }
            }
        }
        return [
            'items' => $result
        ];
    }

    public function getAll()
    {
        return $this->accessaryRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }

    public function getCarUsed(Request $request) {
        $id = $request->id;
        $accessary = $this->accessaryRepository->find($id);
        $carList = $accessary->carLinks;
        $carUsedList = array();
        if (!empty($carList)) {
            foreach ($carList as $item) {
                $car = $this->carRepository->find($item->car_id);
                $catalogCar = $car->catalogCar;
                $carBrand = $car->catalogCar->carBrand;
                $car->carBrandName = $carBrand->name;
                $car->catalogCarName = $catalogCar->name;
                $car->year = $car->yearManufacture->year;
                array_push($carUsedList, $car);
            }
        }
        return [
            'data' => $carUsedList
        ];
    }

    public function import(Request $request) {
        if (!$request->hasFile('files')) {
            return [
                'system_error' => 'Không tồn tại tệp tin!'
            ];
        }

        $files = $request->files;
        $count = 0;

        try {
            foreach ($files as $file) {
                $array = (new AccessaryImport)->toArray($file[0])[0];
                array_shift($array);
                foreach ($array as $item) {
                    $trademark = $this->tradeMarkRepository->findByCode($item[1])->first();
                    $nation = $this->nationRepository->findByCode($item[2])->first();

                    $listAccessary = $item[13] ? explode(',', $item[13]) : null;
                    if (!empty($listAccessary)) {
                        $listAccessary = $this->accessaryRepository->getAccessaryIdByCode($listAccessary);
                    }

                    $listCar = $item[14] ? explode(',', $item[14]) : null;
                    if (!empty($listCar)) {
                        $listCar = $this->carRepository->getCarIdByCode($listCar);
                    }

                    $partsAccessary = array();
                    $listParts = $item[15] ? explode(',', $item[15]) : null;
                    if (!empty($listParts)) {
                        $listParts = $this->catalogPartsRepository->getCatalogPartsIdByCode($listParts);
                        if (!empty($listParts)) {
                            foreach ($listParts as $parts) {
                                array_push($partsAccessary, $parts->catalog_parts_id);
                            }
                        }
                    }
                    
                    $accessary = $this->accessaryRepository->findByCode($item[4])->first();
                    $car = $this->carRepository->getCarIdByCode([$item[0]])->first();
                    if ($accessary) {
                        $accessary = $this->accessaryRepository->merge($accessary->accessary_id, [
                            'car_id' => $car ? $car->car_id : null,
                            'trademark_id' => $trademark ? $trademark->trademark_id : null,
                            'nation_id' => $nation ? $nation->nation_id : null,
                            'type' => $item[3],
                            'code' => $item[4],
                            'name_en' => $item[5],
                            'name_vi' => $item[6],
                            'acronym_name' => $item[7],
                            'unsigned_name' => $item[8],
                            'dvt' => $item[9],
                            'quantity' => $item[10],
                            'price' => $item[11],
                            'prioritize' => $item[12]
                        ]);
                    } else {
                        $accessary = $this->accessaryRepository->persist([
                            'car_id' => $car ? $car->car_id : null,
                            'trademark_id' => $trademark ? $trademark->trademark_id : null,
                            'nation_id' => $nation ? $nation->nation_id : null,
                            'type' => $item[3],
                            'code' => $item[4],
                            'name_en' => $item[5],
                            'name_vi' => $item[6],
                            'acronym_name' => $item[7],
                            'unsigned_name' => $item[8],
                            'dvt' => $item[9],
                            'quantity' => $item[10],
                            'price' => $item[11],
                            'prioritize' => $item[12],
                            'status' => GlobalEnum::STATUS_ACTIVE
                        ]);
                    }

                    if (!empty($listAccessary)) {
                        foreach ($listAccessary as $link) {
                            $check = $this->accessaryLinkRepository->findByIdValue($accessary->accessary_id, $link->accessary_id)->first();
                            if (!$check) {
                                $this->accessaryLinkRepository->persist([
                                    'accessary_id' => $accessary->accessary_id,
                                    'accessary_value' => $link->accessary_id
                                ]);
                            }
                        }
                    }

                    if (!empty($listCar)) {
                        foreach ($listCar as $carUse) {
                            $check = $this->carRepository->find($carUse->car_id);
                            if ($check && !empty($partsAccessary)) {
                                $check->catalogParts()->sync($partsAccessary);
                            }

                            $check = $this->carLinkRepository->findByIdValue($accessary->accessary_id, $carUse->car_id)->first();
                            if (!$check) {
                                $this->carLinkRepository->persist([
                                    'accessary_id' => $accessary->accessary_id,
                                    'car_id' => $carUse->car_id
                                ]);
                            }
                        }
                    }

                    if (!empty($partsAccessary)) {
                        $accessary->catalogParts()->sync($partsAccessary);
                        $car = $this->carRepository->find($accessary->car_id);
                        $car->catalogParts()->sync($partsAccessary);
                    }

                    $count++;
                }
            }

            // Get List CarBrand
            $listAccessary = $this->accessaryRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
            foreach ($listAccessary as $accessary) {
                $car = $this->carRepository->find($accessary->car_id);
                if (!empty($car)) {
                    $catalogCar = $car->catalogCar;
                    $carBrand = $car->catalogCar->carBrand;
                    $accessary->carBrandName = $carBrand->name;
                    $accessary->catalogCarName = $catalogCar->name;
                    $accessary->carName = $car->name;
                    $accessary->year = $car->yearManufacture ? $car->yearManufacture->year : '';
                } else {
                    $accessary->carBrandName = "";
                    $accessary->catalogCarName = "";
                    $accessary->carName = "";
                    $accessary->year = "";
                }
            }
            $view = view('admin.accessary_management.elements.list_data_accessary')
                ->with('listAccessary', $listAccessary)->render();
            return [
                'system_error' => '',
                'html' => $view,
                'count' => $count
            ];

        } catch (\Exception $e) {
            return [
                'system_error' => $e->getMessage()
            ];
        }
    }

}
