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
        $listAccessary = $this->accessaryRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        return view('admin.accessary_management.accessary_management')
            ->with('listAccessary', $listAccessary);
    }

    public function getById(Request $request)
    {
        $accessaryList = array();
        $accessary = $this->accessaryRepository->find($request->id);
        if (!empty($accessary->photo_top))
        {
            $contents = Storage::get($accessary->photo_top);
            $type = pathinfo($accessary->photo_top, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $accessary->photo_top = $base64;
        }
        if (!empty($accessary->photo_bottom))
        {
            $contents = Storage::get($accessary->photo_bottom);
            $type = pathinfo($accessary->photo_bottom, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $accessary->photo_bottom = $base64;
        }
        if (!empty($accessary->photo_left))
        {
            $contents = Storage::get($accessary->photo_left);
            $type = pathinfo($accessary->photo_left, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $accessary->photo_left = $base64;
        }
        if (!empty($accessary->photo_right))
        {
            $contents = Storage::get($accessary->photo_right);
            $type = pathinfo($accessary->photo_right, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $accessary->photo_right = $base64;
        }
        if (!empty($accessary->photo_inner))
        {
            $contents = Storage::get($accessary->photo_inner);
            $type = pathinfo($accessary->photo_inner, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $accessary->photo_inner = $base64;
        }
        if (!empty($accessary->photo_outer))
        {
            $contents = Storage::get($accessary->photo_outer);
            $type = pathinfo($accessary->photo_outer, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $accessary->photo_outer = $base64;
        }

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
        $valid = new Accessary();
        $accessary = $request->all();
        try {
            // Update
            if (isset($request->accessary_id))
            {
                $exists = $this->accessaryRepository->find($request->accessary_id);
                if ($request->hasFile('photo_top'))
                {
                    if (!empty($exists->photo_top))
                    {
                        CommonUtils::deleteFile($exists->photo_top);
                    }
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary', GlobalEnum::IMAGE);
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
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary', GlobalEnum::IMAGE);
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
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary', GlobalEnum::IMAGE);
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
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary', GlobalEnum::IMAGE);
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
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary', GlobalEnum::IMAGE);
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
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary', GlobalEnum::IMAGE);
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
                    $pathPhotoTop = CommonUtils::uploadFile($request->photo_top, 'accessary', GlobalEnum::IMAGE);
                    unset($accessary['photo_top']);
                    $accessary = array_add($accessary, 'photo_top', $pathPhotoTop);
                    $accessary = array_add($accessary, 'photo_top_name', $request->photo_top->getClientOriginalName());
                }
                if ($request->hasFile('photo_bottom'))
                {
                    $pathPhotoBottom = CommonUtils::uploadFile($request->photo_bottom, 'accessary', GlobalEnum::IMAGE);
                    unset($accessary['photo_bottom']);
                    $accessary = array_add($accessary, 'photo_bottom', $pathPhotoBottom);
                    $accessary = array_add($accessary, 'photo_bottom_name', $request->photo_bottom->getClientOriginalName());
                }
                if ($request->hasFile('photo_left'))
                {
                    $pathPhotoLeft = CommonUtils::uploadFile($request->photo_left, 'accessary', GlobalEnum::IMAGE);
                    unset($accessary['photo_left']);
                    $accessary = array_add($accessary, 'photo_left', $pathPhotoLeft);
                    $accessary = array_add($accessary, 'photo_left_name', $request->photo_left->getClientOriginalName());
                }
                if ($request->hasFile('photo_right'))
                {
                    $pathPhotoRight = CommonUtils::uploadFile($request->photo_right, 'accessary', GlobalEnum::IMAGE);
                    unset($accessary['photo_right']);
                    $accessary = array_add($accessary, 'photo_right', $pathPhotoRight);
                    $accessary = array_add($accessary, 'photo_right_name', $request->photo_right->getClientOriginalName());
                }
                if ($request->hasFile('photo_inner'))
                {
                    $pathPhotoInner = CommonUtils::uploadFile($request->photo_inner, 'accessary', GlobalEnum::IMAGE);
                    unset($accessary['photo_inner']);
                    $accessary = array_add($accessary, 'photo_inner', $pathPhotoInner);
                    $accessary = array_add($accessary, 'photo_inner_name', $request->photo_inner->getClientOriginalName());
                }
                if ($request->hasFile('photo_outer'))
                {
                    $pathPhotoOuter = CommonUtils::uploadFile($request->photo_outer, 'accessary', GlobalEnum::IMAGE);
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
        $listAccessary = $this->accessaryRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.accessary_management.elements.list_data_accessary')
            ->with('listAccessary', $listAccessary)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function delete(Request $request)
    {

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
