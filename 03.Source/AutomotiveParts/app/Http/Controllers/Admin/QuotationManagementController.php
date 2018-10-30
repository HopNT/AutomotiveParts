<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/29/2018
 * Time: 22:38
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Repository\QuotationRepository;

class QuotationManagementController extends BackendController {

    protected $quotationRepository;

    /**
     * QuotationManagementController constructor.
     * @param $quotationRepository
     */
    public function __construct(QuotationRepository $quotationRepository)
    {
        $this->quotationRepository = $quotationRepository;
    }

    public function index() {
        $listQuotation = $this->quotationRepository->getAll();
        return view('admin.quotation.quotation_management')
            ->with('listQuotation', $listQuotation);
    }

    public function create() {
        $listTemp = array();
        return view('admin.quotation.elements.form_add_update_quotation')
            ->with('listTemp', $listTemp)->render();
    }

}
