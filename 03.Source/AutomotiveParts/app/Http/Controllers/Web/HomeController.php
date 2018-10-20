<?php

namespace App\Http\Controllers\Web;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\PartsRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    protected $catalogPartsRepository;

    protected $partsRepository;

//    protected $iHangXeRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository, PartsRepository $partsRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
        $this->partsRepository = $partsRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $listCatalogPartsParent = $this->catalogPartsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE)
//            ->where('parent_id', '=', null);
//        foreach ($listCatalogPartsParent as $catalogPartsParent) {
//            $catalogPartsParent->child;
//        }

        return view('home');
    }

}
