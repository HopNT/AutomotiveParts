<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/25/2018
 * Time: 01:32
 */
namespace App\Http\Controllers\Web;

use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\PartsRepository;
use Illuminate\Http\Request;

class PartsController {

    protected $catalogPartsRepository;

    protected $partsRepository;

    /**
     * PartsController constructor.
     * @param $catalogPartsRepository
     * @param $partsRepository
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository, PartsRepository $partsRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
        $this->partsRepository = $partsRepository;
    }

    public function loadListAccessory(Request $request) {
        $catalogPartsId = $request->catalog_parts_id;
        $catalogParts = $this->catalogPartsRepository->find($catalogPartsId);
        $listParts = $catalogParts->parts;
        $listAccessaryPrioritize = array();
        if ($listParts->count()) {
            foreach ($listParts as $parts) {
                $listAccessary = $parts->accessarys;
                foreach ($listAccessary as $item) {
                    array_push($listAccessaryPrioritize, $item);
                }
            }
        }
        return view('web.accessory.list-accessory')
            ->with('listAccessaryPrioritize', $listAccessaryPrioritize);
    }
}
