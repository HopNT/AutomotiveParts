<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/21/2018
 * Time: 10:29
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\PartsRepository;

class PartsManagementController extends BackendController
{
    protected $catalogPartsRepository;

    protected $partsRepository;

    /**
     * PartsManagementController constructor.
     * @param $catalogPartsRepository
     * @param $partsRepository
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository, PartsRepository $partsRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
        $this->partsRepository = $partsRepository;
    }

    public function index()
    {
        $listCatalogParts = $this->catalogPartsRepository->getAll()->where('status', GlobalEnum::STATUS_ACTIVE);
        $listParts = $this->partsRepository->getAllByActive(GlobalEnum::STATUS_ACTIVE);
        return view('admin.parts_management.parts_management')
            ->with('listCatalogParts', $listCatalogParts)
            ->with('listParts', $listParts);
    }
}
