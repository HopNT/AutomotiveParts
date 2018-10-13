<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/03/2018
 * Time: 10:05
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\Accessary;
use App\Http\Common\Entities\TempPrice;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\TempPriceRepository;
use App\Http\Common\Repository\UserRepository;
use App\Http\Common\Utils\CommonUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TempPriceManagementController extends BackendController
{
    protected $tempPriceRepository;

    protected $userRepository;

    protected $accessaryRepository;

    /**
     * TempPriceManagementController constructor.
     * @param $tempPriceRepository
     * @param $userRepository
     * @param $accessaryRepository
     */
    public function __construct(TempPriceRepository $tempPriceRepository, UserRepository $userRepository, AccessaryRepository $accessaryRepository)
    {
        $this->tempPriceRepository = $tempPriceRepository;
        $this->userRepository = $userRepository;
        $this->accessaryRepository = $accessaryRepository;
    }

    public function index()
    {
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $userId = $user->user_id;
        $listTempPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByProductProvider($userId);
        }
        return view('admin.temp_price_management.temp_price_management')
            ->with('listTempPrice', $listTempPrice);
    }

    public function getById(Request $request)
    {
        $id = $request->id;
        $tempPrice = $this->tempPriceRepository->find($id);
        return [
            'data' => $tempPrice
        ];
    }

    public function save(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $valid = new TempPrice();
        $tempPrice = $request->all();
        try {
            $validator = Validator::make($tempPrice, $valid->rules, [], $valid->attributes);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }
            // Update
            if (isset($request->temp_price_id))
            {
                $exists = $this->tempPriceRepository->find($request->temp_price_id);
                if ($request->hasFile('photo_top'))
                {
                    if (!empty($exists->photo_top))
                    {
                        CommonUtils::deleteFile($exists->photo_top);
                    }
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_top']);
                    $tempPrice = array_add($tempPrice, 'photo_top', $pathPhotoTop);
                    $tempPrice = array_add($tempPrice, 'photo_top_name', $request->photo_top->getClientOriginalName());
                }

                if ($request->hasFile('photo_bottom'))
                {
                    if (!empty($exists->photo_bottom))
                    {
                        CommonUtils::deleteFile($exists->photo_bottom);
                    }
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_bottom']);
                    $tempPrice = array_add($tempPrice, 'photo_bottom', $pathPhotoBottom);
                    $tempPrice = array_add($tempPrice, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                }

                if ($request->hasFile('photo_left'))
                {
                    if (!empty($exists->photo_left))
                    {
                        CommonUtils::deleteFile($exists->photo_left);
                    }
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_left']);
                    $tempPrice = array_add($tempPrice, 'photo_left', $pathPhotoLeft);
                    $tempPrice = array_add($tempPrice, 'photo_left_name', $request->photo_left->getClientOriginalName());
                }

                if ($request->hasFile('photo_right'))
                {
                    if (!empty($exists->photo_right))
                    {
                        CommonUtils::deleteFile($exists->photo_right);
                    }
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_right']);
                    $tempPrice = array_add($tempPrice, 'photo_right', $pathPhotoRight);
                    $tempPrice = array_add($tempPrice, 'photo_right_name', $request->photo_right->getClientOriginalName());
                }

                if ($request->hasFile('photo_inner'))
                {
                    if (!empty($exists->photo_inner))
                    {
                        CommonUtils::deleteFile($exists->photo_inner);
                    }
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_inner']);
                    $tempPrice = array_add($tempPrice, 'photo_inner', $pathPhotoInner);
                    $tempPrice = array_add($tempPrice, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                }

                if ($request->hasFile('photo_outer'))
                {
                    if (!empty($exists->photo_outer))
                    {
                        CommonUtils::deleteFile($exists->photo_outer);
                    }
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_outer']);
                    $tempPrice = array_add($tempPrice, 'photo_outer', $pathPhotoOuter);
                    $tempPrice = array_add($tempPrice, 'photo_outer_name', $request->photo_outer->getClientOriginalName());
                }

                $this->tempPriceRepository->merge($request->temp_price_id, $tempPrice);
            }
            else // Insert
            {
                $exists = $this->tempPriceRepository->findByCodeAndUserId($request->code, $user->user_id);
                if (!empty($exists->all())) {
                    return [
                        'system_error' => true,
                        'message_error' => 'Phụ tùng này đã tồn tại, vui lòng kiểm tra lại'
                    ];
                }

                if ($request->hasFile('photo_top'))
                {
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_top']);
                    $tempPrice = array_add($tempPrice, 'photo_top', $pathPhotoTop);
                    $tempPrice = array_add($tempPrice, 'photo_top_name', $request->photo_top->getClientOriginalName());
                }
                if ($request->hasFile('photo_bottom'))
                {
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_bottom']);
                    $tempPrice = array_add($tempPrice, 'photo_bottom', $pathPhotoBottom);
                    $tempPrice = array_add($tempPrice, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                }
                if ($request->hasFile('photo_left'))
                {
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_left']);
                    $tempPrice = array_add($tempPrice, 'photo_left', $pathPhotoLeft);
                    $tempPrice = array_add($tempPrice, 'photo_left_name', $request->photo_left->getClientOriginalName());
                }
                if ($request->hasFile('photo_right'))
                {
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_right']);
                    $tempPrice = array_add($tempPrice, 'photo_right', $pathPhotoRight);
                    $tempPrice = array_add($tempPrice, 'photo_right_name', $request->photo_right->getClientOriginalName());
                }
                if ($request->hasFile('photo_inner'))
                {
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_inner']);
                    $tempPrice = array_add($tempPrice, 'photo_inner', $pathPhotoInner);
                    $tempPrice = array_add($tempPrice, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                }
                if ($request->hasFile('photo_outer'))
                {
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($tempPrice['photo_outer']);
                    $tempPrice = array_add($tempPrice, 'photo_outer', $pathPhotoOuter);
                    $tempPrice = array_add($tempPrice, 'photo_outer_name', $request->photo_outer->getClientOriginalName());
                }
                $tempPrice = array_add($tempPrice, 'status', GlobalEnum::STATUS_PENDING);
                $tempPrice = array_add($tempPrice, 'user_id', $user->user_id);
                $this->tempPriceRepository->persist($tempPrice);
            }
        }
        catch (\Exception $e)
        {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        // Get List temp price
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listTempPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByProductProvider($user->user_id);
        }
        $view = view('admin.temp_price_management.elements.list_data_temp_price')
            ->with('listTempPrice', $listTempPrice)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function approve(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $key => $id) {
            $attach = false;
            $temp = $this->tempPriceRepository->find($id);
            $temp->status = GlobalEnum::STATUS_APPROVE;
            $temp->updated_at = now();
            $this->tempPriceRepository->merge($id, $temp->toArray());
            $accessary = $this->accessaryRepository->findByCode($temp->code);
            if (empty($accessary->all()) || $temp->code != $accessary->all()[0]->code) {
                $accessary = new Accessary();
                $accessary->trademark_id = $temp->trademark_id;
                $accessary->nation_id = $temp->nation_id;
                $accessary->type = $temp->type;
                $accessary->code = $temp->code;
                $accessary->name_en = $temp->name_en;
                $accessary->name_vi = $temp->name_vi;
                $accessary->acronym_name = $temp->acronym_name;
                $accessary->unsigned_name = $temp->unsigned_name;
                $accessary->photo_top = $temp->photo_top;
                $accessary->photo_top_name = $temp->photo_top_name;
                $accessary->photo_bottom = $temp->photo_bottom;
                $accessary->photo_bottom_name = $temp->photo_bottom_name;
                $accessary->photo_left = $temp->photo_left;
                $accessary->photo_left_name = $temp->photo_left_name;
                $accessary->photo_right = $temp->photo_right;
                $accessary->photo_right_name = $temp->photo_right_name;
                $accessary->photo_inner = $temp->photo_inner;
                $accessary->photo_inner_name = $temp->photo_inner_name;
                $accessary->photo_outer = $temp->photo_outer;
                $accessary->photo_outer_name = $temp->photo_outer_name;
                $accessary->description = $temp->description;
                $accessary->status = GlobalEnum::STATUS_ACTIVE;
                $accessary->created_at = now();
                $accessary->updated_at = now();
                $accessary = $this->accessaryRepository->persist($accessary->toArray());
                $attach = true;
            }
            $user = $this->userRepository->find($temp->user_id);
            if (!empty($user) && (!empty($temp->garage_price) || !empty($temp->retail_price) || !empty($temp->quantity)) ) {
                if ($attach) {
                    $user->accessarys()->attach($accessary->accessary_id, ['garage_price' => $temp->garage_price, 'retail_price' => $temp->retail_price, 'quantity' => $temp->quantity, 'status' => GlobalEnum::STATUS_ACTIVE, 'created_at' => now(), 'updated_at' => now()]);
                } else {
                    $user->accessarys()->attach($accessary->all()[0]->accessary_id, ['garage_price' => $temp->garage_price, 'retail_price' => $temp->retail_price, 'quantity' => $temp->quantity, 'status' => GlobalEnum::STATUS_ACTIVE, 'created_at' => now(), 'updated_at' => now()]);
                }
            }
        }
        // Get List temp price
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listTempPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByProductProvider($user->user_id);
        }
        $view = view('admin.temp_price_management.elements.list_data_temp_price')
            ->with('listTempPrice', $listTempPrice)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function reject(Request $request)
    {
        $ids = $request->ids;
        $this->tempPriceRepository->reject($ids);
        // Get List temp price
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listTempPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByProductProvider($user->user_id);
        }
        $view = view('admin.temp_price_management.elements.list_data_temp_price')
            ->with('listTempPrice', $listTempPrice)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->tempPriceRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List temp price
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listTempPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByProductProvider($user->user_id);
        }
        $view = view('admin.temp_price_management.elements.list_data_temp_price')
            ->with('listTempPrice', $listTempPrice)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

}
