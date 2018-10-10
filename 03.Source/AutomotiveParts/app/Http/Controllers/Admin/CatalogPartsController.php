<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 11:04
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\CatalogParts;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\PartsRepository;
use App\Http\Common\Utils\CommonUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CatalogPartsController extends BackendController
{
    protected $catalogPartsRepository;

    protected $partsRepository;

    /**
     * CatalogPartsController constructor.
     * @param $catalogPartsRepository
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository, PartsRepository $partsRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
        $this->partsRepository = $partsRepository;
    }

    public function searchByText(Request $request) {
        $results = array();
        $text = $request->get('query');
        $listCatalogParts = $this->catalogPartsRepository->searchByText($text);
        $index = 0;
        if (!empty($listCatalogParts))
        {
            foreach ($listCatalogParts as $key => $catalogPart)
            {
                $results[$index]['id'] = $catalogPart->catalog_parts_id;
                $results[$index]['text'] = $catalogPart->name;
                $index++;
            }
        }
        return [
            'items' => $results
        ];
    }

    public function save(Request $request)
    {
        $valid = new CatalogParts();
        $catalogParts = $request->all();
        try
        {
            $validator = Validator::make($request->all(), $valid->rules, [], $valid->attributes);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }

            if (isset($request->catalog_parts_id)) {
                $exists = $this->catalogPartsRepository->find($request->catalog_parts_id);
                if ($exists->status === 0 && $exists->status !== $request->status
                        && $exists->parent_id !== null && $exists->parent_id !== $exists->catalog_parts_id) {
                    $parent = $this->catalogPartsRepository->find($exists->parent_id);
                    if ($parent->status === 0) {
                        return [
                            'system_error' => true,
                            'message_error' => 'Nhóm cha đã bị ngừng sử dụng, không thể cập nhật nhóm hiện tại'
                        ];
                    }
                }

                if ($request->hasFile('photo') and !empty($request->photo)) {
                    if (!empty($exists->icon))
                    {
                        CommonUtils::deleteFile($exists->icon);
                    }
                    $pathPhoto = CommonUtils::uploadFile($request->photo, 'catalog_parts', GlobalEnum::ICON);
                    $catalogParts = array_add($catalogParts, 'icon_name', $request->photo->getClientOriginalName());
                    $catalogParts = array_add($catalogParts, 'icon', $pathPhoto);
                }

                if (empty($request->parent_id)) {
                    $catalogParts = array_add($catalogParts, 'parent_id', null);
                }

                $this->catalogPartsRepository->merge($request->catalog_parts_id, $catalogParts);
            } else {
                if ($request->hasFile('photo')) {
                    $pathPhoto = CommonUtils::uploadFile($request->photo, 'catalog_parts', GlobalEnum::ICON);
                    $catalogParts = array_add($catalogParts, 'icon_name', $request->photo->getClientOriginalName());
                    $catalogParts = array_add($catalogParts, 'icon', $pathPhoto);
                }
                $catalogParts = array_add($catalogParts, 'status', GlobalEnum::STATUS_ACTIVE);
                $this->catalogPartsRepository->persist($catalogParts);
            }
        }
        catch (\Exception $e)
        {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        // Get List catalog parts
        $listCatalogParts = $this->catalogPartsRepository->getAll();
        $listParts = $this->partsRepository->getAllByActive(GlobalEnum::STATUS_ACTIVE);
        $viewCatalogParts = view('admin.parts_management.elements.list_data_catalog_parts')
            ->with('listCatalogParts', $listCatalogParts)->render();
        $viewParts = view('admin.parts_management.elements.list_data_parts')
            ->with('listParts', $listParts)->render();
        return [
            'error' => false,
            'catalogParts' => $viewCatalogParts,
            'parts' => $viewParts
        ];
    }

    public function getById(Request $request)
    {
        $catalogParts = $this->catalogPartsRepository->find($request->id);
        if (!empty($catalogParts->icon))
        {
            $contents = Storage::get($catalogParts->icon);
            $type = pathinfo($catalogParts->icon, PATHINFO_EXTENSION);
            $base64 = 'data:image/'.$type.';base64,'.base64_encode($contents);
            $catalogParts->icon = $base64;
        }
        $parent = null;
        if (!empty($catalogParts->parent_id)) {
            $parent = $this->catalogPartsRepository->find($catalogParts->parent_id);
        }
        return [
            'data' => $catalogParts,
            'parent' => $parent
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->catalogPartsRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List catalog parts
        $listCatalogParts = $this->catalogPartsRepository->getAll();
        $listParts = $this->partsRepository->getAllByActive(GlobalEnum::STATUS_ACTIVE);
        $viewCatalogParts = view('admin.parts_management.elements.list_data_catalog_parts')
            ->with('listCatalogParts', $listCatalogParts)->render();
        $viewParts = view('admin.parts_management.elements.list_data_parts')
            ->with('listParts', $listParts)->render();
        return [
            'error' => false,
            'catalogParts' => $viewCatalogParts,
            'parts' => $viewParts
        ];
    }

    public function getAll()
    {
        return $this->catalogPartsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }
}
