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
use App\Http\Common\Repository\AccessaryLinkRepository;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Utils\CommonUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccessaryManagementController extends BackendController
{
    protected $accessaryRepository;

    protected $accessaryLinkRepository;

    /**
     * AccessaryManagementController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository, AccessaryLinkRepository $accessaryLinkRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
        $this->accessaryLinkRepository = $accessaryLinkRepository;
    }

    public function index()
    {
        $listAccessary = $this->accessaryRepository->getAll();
        return view('admin.accessary_management.accessary_management')
            ->with('listAccessary', $listAccessary);
    }

    public function getById(Request $request)
    {
        $accessaryList = array();
        $accessary = $this->accessaryRepository->find($request->id);
        foreach ($accessary->accessaryLinks as $key => $item) {
            $accessaryLink = $this->accessaryRepository->find($item->accessary_value);
            $accessaryList[$key] = $accessaryLink->toArray();
        }
        return [
            'data' => $accessary,
            'list' => $accessaryList
        ];
    }

    public function save(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $valid = new Accessary();
        $accessary = $request->all();
        // dd($accessary);
        try {
            // Update
            $time = time();
            if (isset($request->accessary_id))
            {
                $exists = $this->accessaryRepository->find($request->accessary_id);
                if ($request->hasFile('photo_top'))
                {
                    if (!empty($exists->photo_top))
                    {
                        CommonUtils::deleteFile($exists->photo_top);
                    }
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_top']);
                    $accessary = array_add($accessary, 'photo_top', $pathPhotoTop);
                    $accessary = array_add($accessary, 'photo_top_name', $request->photo_top->getClientOriginalName());
                }

                if ($request->hasFile('photo_bottom'))
                {
                    if (!empty($exists->photo_bottom))
                    {
                        CommonUtils::deleteFile($exists->photo_bottom);
                    }
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_bottom']);
                    $accessary = array_add($accessary, 'photo_bottom', $pathPhotoBottom);
                    $accessary = array_add($accessary, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                }

                if ($request->hasFile('photo_left'))
                {
                    if (!empty($exists->photo_left))
                    {
                        CommonUtils::deleteFile($exists->photo_left);
                    }
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_left']);
                    $accessary = array_add($accessary, 'photo_left', $pathPhotoLeft);
                    $accessary = array_add($accessary, 'photo_left_name', $request->photo_left->getClientOriginalName());
                }

                if ($request->hasFile('photo_right'))
                {
                    if (!empty($exists->photo_right))
                    {
                        CommonUtils::deleteFile($exists->photo_right);
                    }
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_right']);
                    $accessary = array_add($accessary, 'photo_right', $pathPhotoRight);
                    $accessary = array_add($accessary, 'photo_right_name', $request->photo_right->getClientOriginalName());
                }

                if ($request->hasFile('photo_inner'))
                {
                    if (!empty($exists->photo_inner))
                    {
                        CommonUtils::deleteFile($exists->photo_inner);
                    }
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_inner']);
                    $accessary = array_add($accessary, 'photo_inner', $pathPhotoInner);
                    $accessary = array_add($accessary, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                }

                if ($request->hasFile('photo_outer'))
                {
                    if (!empty($exists->photo_outer))
                    {
                        CommonUtils::deleteFile($exists->photo_outer);
                    }
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_outer']);
                    $accessary = array_add($accessary, 'photo_outer', $pathPhotoOuter);
                    $accessary = array_add($accessary, 'photo_outer_name', $request->photo_outer->getClientOriginalName());
                }

                $this->accessaryRepository->merge($request->accessary_id, $accessary);

                if ($request->has('accessary_link')) {
                    $this->accessaryLinkRepository->deleteAll($request->accessary_id);
                    foreach ($request->accessary_link as $id) {
                        $accessaryLink = [
                            'accessary_id' => $accessary['accessary_id'],
                            'accessary_value' => $id
                        ];
                        $this->accessaryLinkRepository->persist($accessaryLink);
                    }
                } else {
                    $this->accessaryLinkRepository->deleteAll($request->accessary_id);
                }
            }
            else // Insert
            {
                $validator = Validator::make($accessary, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                if ($request->hasFile('photo_top'))
                {
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_top']);
                    $accessary = array_add($accessary, 'photo_top', $pathPhotoTop);
                    $accessary = array_add($accessary, 'photo_top_name', $request->photo_top->getClientOriginalName());
                }
                if ($request->hasFile('photo_bottom'))
                {
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_bottom']);
                    $accessary = array_add($accessary, 'photo_bottom', $pathPhotoBottom);
                    $accessary = array_add($accessary, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                }
                if ($request->hasFile('photo_left'))
                {
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_left']);
                    $accessary = array_add($accessary, 'photo_left', $pathPhotoLeft);
                    $accessary = array_add($accessary, 'photo_left_name', $request->photo_left->getClientOriginalName());
                }
                if ($request->hasFile('photo_right'))
                {
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_right']);
                    $accessary = array_add($accessary, 'photo_right', $pathPhotoRight);
                    $accessary = array_add($accessary, 'photo_right_name', $request->photo_right->getClientOriginalName());
                }
                if ($request->hasFile('photo_inner'))
                {
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_inner']);
                    $accessary = array_add($accessary, 'photo_inner', $pathPhotoInner);
                    $accessary = array_add($accessary, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                }
                if ($request->hasFile('photo_outer'))
                {
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    unset($accessary['photo_outer']);
                    $accessary = array_add($accessary, 'photo_outer', $pathPhotoOuter);
                    $accessary = array_add($accessary, 'photo_outer_name', $request->photo_outer->getClientOriginalName());
                }
                $accessary = array_add($accessary, 'status', GlobalEnum::STATUS_ACTIVE);
                $accessary = $this->accessaryRepository->persist($accessary);

                if ($request->has('accessary_link')) {
                    foreach ($request->accessary_link as $id) {
                        $accessaryLink = [
                            'accessary_id' => $accessary['accessary_id'],
                            'accessary_value' => $id
                        ];
                        $this->accessaryLinkRepository->persist($accessaryLink);
                    }
                }
            }
        }
        catch (\Exception $e)
        {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
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

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->accessaryRepository->deleteMulti($ids);
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

}
