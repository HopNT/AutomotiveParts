<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/29/2018
 * Time: 22:38
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\CarBrandRepository;
use App\Http\Common\Repository\CarRepository;
use App\Http\Common\Repository\CatalogCarRepository;
use App\Http\Common\Repository\NationRepository;
use App\Http\Common\Repository\QuotationRepository;
use App\Http\Common\Repository\TradeMarkRepository;

class QuotationManagementController extends BackendController {

    protected $quotationRepository;

    protected $carBrandRepository;

    protected $catalogCarRepository;

    protected $carRepository;

    protected $tradeMarkRepository;

    protected $nationRepository;

    /**
     * QuotationManagementController constructor.
     * @param $quotationRepository
     */
    public function __construct(QuotationRepository $quotationRepository, CarBrandRepository $carBrandRepository,
                                CatalogCarRepository $catalogCarRepository, CarRepository $carRepository,
                                TradeMarkRepository $tradeMarkRepository, NationRepository $nationRepository)
    {
        $this->quotationRepository = $quotationRepository;
        $this->carBrandRepository = $carBrandRepository;
        $this->catalogCarRepository = $catalogCarRepository;
        $this->carRepository = $carRepository;
        $this->tradeMarkRepository = $tradeMarkRepository;
        $this->nationRepository = $nationRepository;
    }

    public function index() {
        $listQuotation = $this->quotationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        return view('admin.quotation.quotation_management')
            ->with('listQuotation', $listQuotation);
    }

    public function create() {
        $listTemp = array();
        $carBrandList = $this->carBrandRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);;
        $tradeMarkList = $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $nationList = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        return view('admin.quotation.elements.form_add_update_quotation')
            ->with('car', null)
            ->with('carBrandList', $carBrandList)
            ->with('tradeMarkList', $tradeMarkList)
            ->with('nationList', $nationList)
            ->with('listTemp', $listTemp)->render();
    }

}
