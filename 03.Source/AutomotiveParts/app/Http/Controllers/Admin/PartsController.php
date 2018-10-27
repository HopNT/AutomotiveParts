<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 14:34
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\Parts;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\PartsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Common\Utils\CommonUtils;

class PartsController extends BackendController
{

    protected $partsRepository;

    /**
     * PartsController constructor.
     * @param $partsRepository
     */
    public function __construct(PartsRepository $partsRepository)
    {
        $this->partsRepository = $partsRepository;
    }

    public function getAll()
    {
        return $this->partsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }

    public function searchByText(Request $request)
    {
        $results = array();
        $text = $request->get('query');
        $listParts = $this->partsRepository->searchByText($text);
        $index = 0;
        if (!empty($listParts))
        {
            foreach ($listParts as $key => $parts)
            {
                $results[$index]['id'] = $parts->parts_id;
                $results[$index]['text'] = $parts->code.' - '.$parts->name;
                $index++;
            }
        }
        return [
            'items' => $results
        ];
    }

    public function loadListAccessorysave(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $valid = new Parts();
        $parts = $request->all();
        try {
            if ($request->has('accessary'))
            {
                $accessary = $parts['accessary'];
            }
            if ($request->hasFile('image_file'))
            {
                $file = $request->image_file;
                unset($parts['image_file']);
            }

            // Update
            if (isset($request->parts_id))
            {
                $validator = Validator::make($parts, $valid->rules_update, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }

                $exists = $this->partsRepository->find($request->parts_id);
                if (!empty($file))
                {
                    if (!empty($exists->photo))
                    {
                        CommonUtils::deleteFile($exists->photo);
                    }
                    $pathPhoto = CommonUtils::uploadFile($file, 'parts/'.$user->user_id.'/'.$exists->code, GlobalEnum::IMAGE);
                    $parts = array_add($parts, 'photo_name', $file->getClientOriginalName());
                    $parts = array_add($parts, 'photo', $pathPhoto);
                }

                $parts = $this->partsRepository->merge($request->parts_id, $parts);
                if (!empty($accessary))
                {
                    $parts->accessarys()->sync($accessary);
                }
                else
                {
                    $parts->accessarys()->detach();
                }
            }
            else // Insert
            {
                $validator = Validator::make($parts, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                if (!empty($file))
                {
                    $pathPhoto = CommonUtils::uploadFile($file, 'parts/'.$user->user_id.'/'.$request->code, GlobalEnum::IMAGE);
                    $parts = array_add($parts, 'photo_name', $file->getClientOriginalName());
                    $parts = array_add($parts, 'photo', $pathPhoto);
                }
                $parts = array_add($parts, 'status', GlobalEnum::STATUS_ACTIVE);
                $parts = $this->partsRepository->persist($parts);
                if (!empty($accessary))
                {
                    $parts->accessarys()->attach($accessary);
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

        // Get List Parts
        $listParts = $this->partsRepository->getAllByActive(GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.parts_management.elements.list_data_parts')
            ->with('listParts', $listParts)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getById(Request $request)
    {
        $partsId = $request->id;
        $parts = $this->partsRepository->find($partsId);
        $parts->accessarys;
        return [
            'data' => $parts
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->partsRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List parts
        $listParts = $this->partsRepository->getAllByActive(GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.parts_management.elements.list_data_parts')
            ->with('listParts', $listParts)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

}
