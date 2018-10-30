<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/29/2018
 * Time: 22:26
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\Quotation;
use App\Http\Common\Repository\QuotationRepository;
use Illuminate\Support\Facades\DB;

class QuotationRepositoryImpl extends GenericRepositoryImpl implements QuotationRepository {
    /**
     * @return mixed
     */
    public function getModel()
    {
        return Quotation::class;
    }

}
