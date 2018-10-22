<?php

namespace App\Http\Controllers\Web;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\CatalogPartsRepository;
use App\Http\Common\Repository\PartsRepository;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $catalogPartsRepository;

    protected $partsRepository;

    protected $accessaryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CatalogPartsRepository $catalogPartsRepository, PartsRepository $partsRepository, AccessaryRepository $accessaryRepository)
    {
        $this->catalogPartsRepository = $catalogPartsRepository;
        $this->partsRepository = $partsRepository;
        $this->accessaryRepository = $accessaryRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCatalogPartsParent = $this->catalogPartsRepository->getAll()
            ->where('status', '=', GlobalEnum::STATUS_ACTIVE)
            ->where('parent_id', null);
        foreach ($listCatalogPartsParent as $catalogPartsParent) {
            $catalogPartsParent->child;
        }

        $listAccessaryPrioritize = $this->accessaryRepository->getAll()->where('prioritize', '=', GlobalEnum::STATUS_ACTIVE);

        return view('web.home.home')->with('listCatalogPartsParent', $listCatalogPartsParent)
            ->with('listAccessaryPrioritize', $listAccessaryPrioritize);
    }

}
