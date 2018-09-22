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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CatalogPartsController extends BackendController
{
    protected $catalogPartsRepository;

    /**
     * CatalogPartsController constructor.
     * @param $catalogPartsRepository
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
    }

    public function save(Request $request)
    {
        $valid = new CatalogParts();
        $catalogParts = $request->all();
        try
        {
            if (isset($request->catalog_parts_id)) {
                $this->catalogPartsRepository->merge($request->catalog_parts_id, $catalogParts);
            } else {
                $validator = Validator::make($request->all(), $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
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
        $listCatalogParts = $this->catalogPartsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.parts_management.elements.list_data_catalog_parts')
            ->with('listCatalogParts', $listCatalogParts)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getById(Request $request)
    {
        $catalogParts = $this->catalogPartsRepository->find($request->id);
        return [
            'data' => $catalogParts
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
        $listCatalogParts = $this->catalogPartsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.parts_management.elements.list_data_catalog_parts')
            ->with('listCatalogParts', $listCatalogParts)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }
}
