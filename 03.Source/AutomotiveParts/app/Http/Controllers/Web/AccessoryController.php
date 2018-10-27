<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 10/20/2018
 * Time: 2:54 PM
 */

namespace App\Http\Controllers\Web;


use App\Http\Common\Repository\AccessaryLinkRepository;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{

    protected $accessaryRepository;

    protected $accessaryLinkRepository;

    protected $carRepository;

    /**
     * AccessoryController constructor.
     * @param AccessaryRepository $accessaryRepository
     * @param AccessaryLinkRepository $accessaryLinkRepository
     * @param CarRepository $carRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository, AccessaryLinkRepository $accessaryLinkRepository, CarRepository $carRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
        $this->accessaryLinkRepository = $accessaryLinkRepository;
        $this->carRepository = $carRepository;
    }

    public function viewAccessoryDetail(Request $request) {

        $accessaryId = $request->accessary_id;
        $accessary = $this->accessaryRepository->searchById($accessaryId);

        // Get accessary links
        foreach ($accessary as $key => $item) {
            $list = array();
            $accessaryLink = $this->accessaryLinkRepository->getAccessaryLinks($item->accessary_id);
            foreach ($accessaryLink as $key => $link) {
                $sub = $this->accessaryRepository->find($link->accessary_value);
                array_push($list, $sub);
            }
            $item->accessaryLinks = $list;
        }

        // Get car
        $listCarUse = $this->carRepository->getByAccessaryId($accessaryId);

        return view('web.accessory.accessory-detail')
            ->with('accessary', $accessary)
            ->with('listCarUse', $listCarUse);
    }

}
