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
        $listParts = $catalogParts->parts;
        $listAccessaryPrioritize = array();
        if ($listParts->count()) {
//            dd($listParts->pluck('parts_id'));
//            foreach ($listParts as $parts) {
//                $listAccessary = $parts->accessarys;
//                foreach ($listAccessary as $item) {
//                    array_push($listAccessaryPrioritize, $item);
//                }
//            }
            $listAccessaryPrioritize = $this->accessaryRepository->loadByPartsId($listParts->pluck('parts_id'));
        }
        return view('web.accessory.list-accessory')
            ->with('listAccessaryPrioritize', $listAccessaryPrioritize)
            ->with('title',$catalogParts->name);
    }
}
