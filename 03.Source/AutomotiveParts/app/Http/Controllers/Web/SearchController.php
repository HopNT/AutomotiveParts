<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 10/20/2018
 * Time: 2:38 PM
 */

namespace App\Http\Controllers\Web;

use App\Http\Common\Repository\AccessaryLinkRepository;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    protected $accessaryRepository;

    protected $accessaryLinkRepository;

    protected $carRepository;

    /**
     * SearchController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository, AccessaryLinkRepository $accessaryLinkRepository, CarRepository $carRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
        $this->accessaryLinkRepository = $accessaryLinkRepository;
        $this->carRepository = $carRepository;
    }

    public function search(Request $request)
    {
        if (empty($request->q) && empty($request->car_name) && empty($request->year)) {
            return redirect('home');
        }

        $query = $request->q;
        $carName = $request->car_name;
        $year = $request->year;
//        if (strpos($request->q, ',') !== false) {
//            $query = explode(',', $request->q);
//        } else {
//            array_push($query, $request->q);
//        }

        $accessary = $this->accessaryRepository->search($query, $carName, $year);
        if (count($accessary) > 1) {
//            $query = implode(', ', $query);
            return view('web.Search.search-result')
                ->with('query', $query)
                ->with('accessary', $accessary);

        } else {
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
            $listCarUse = $this->carRepository->getByAccessary($query);

            return view('web.accessory.accessory-detail')
                ->with('accessary', $accessary)
                ->with('listCarUse', $listCarUse);
        }
    }

    public function searchByCar(Request $request) {
        $carName = $request->car_name;
        $year = $request->year;
        if (empty($carName) && empty($year)) {
            return redirect('/home');
        }
        $listAccessaryPrioritize = $this->accessaryRepository->searchByCar($carName, $year);
        return view('web.accessory.list-accessory')
            ->with('listAccessaryPrioritize', $listAccessaryPrioritize);
    }

}
