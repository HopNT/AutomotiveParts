<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/25/2018
 * Time: 01:32
 */
namespace App\Http\Controllers\Web;

use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\PartsRepository;
use Illuminate\Http\Request;

class PartsController {

    protected $catalogPartsRepository;

    protected $partsRepository;

    protected $accessaryRepository;

    /**
     * PartsController constructor.
     * @param $catalogPartsRepository
     * @param $partsRepository
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository, PartsRepository $partsRepository, AccessaryRepository $accessaryRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
        $this->partsRepository = $partsRepository;
        $this->accessaryRepository = $accessaryRepository;
    }

    public function loadListAccessory(Request $request) {
        $catalogPartsId = $request->catalog_parts_id;
        $catalogParts = $this->catalogPartsRepository->find($catalogPartsId);
        $listAccessaryPrioritize = array();
        if ($catalogPartsId) {
            $listAccessaryPrioritize = $this->accessaryRepository->loadByPartsId($catalogPartsId);
        }
        return view('web.accessory.list-accessory')
            ->with('listAccessaryPrioritize', $listAccessaryPrioritize)
            ->with('title',$catalogParts->name);
    }
}
