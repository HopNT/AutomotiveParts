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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    protected $accessaryRepository;

    protected $accessaryLinkRepository;

    /**
     * SearchController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository, AccessaryLinkRepository $accessaryLinkRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
        $this->accessaryLinkRepository = $accessaryLinkRepository;
    }

    public function search(Request $request) {
        $query = array();
        if (!empty($request->q1)) {
            array_push($query, $request->q1);
        } else {
            $query = explode(PHP_EOL, $request->q2);
        }

        $accessary = $this->accessaryRepository->searchByMinCost($query);

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

        $view = null;
        if (count($query) > 1) {
            $view = 'web.search.search-result';
            $query = implode(', ',$query);
        } else {
            $view = 'web.accessory.accessory-detail';
        }

        return view($view)
            ->with('query', $query)
            ->with('accessary', $accessary);
    }
}
