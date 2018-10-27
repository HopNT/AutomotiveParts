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
        if (empty($request->q)) {
            return redirect('home');
        }

        $query = array();
        if (strpos($request->q, ',') !== false) {
            $query = explode(',', $request->q);
        } else {
            array_push($query, $request->q);
        }
//        if (!empty($request->q1)) {
//            array_push($query, $request->q1);
//        } else {
//            if (strpos($request->q2, ',') !== false) {
//                $query = explode(',', $request->q2);
//            } else if (strpos($request->q2, PHP_EOL) !== false) {
//                $query = explode(PHP_EOL, $request->q2);
//            }
//        }

        $accessary = $this->accessaryRepository->searchByCode($query);
        if (count($accessary) > 1) {
            $query = implode(', ', $query);
            return view('web.search.search-result')
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

//            dd($accessary);

            return view('web.accessory.accessory-detail')
                ->with('accessary', $accessary)
                ->with('listCarUse', $listCarUse);
        }
    }

}
