<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 14:34
 */

namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\PartsRepository;

class PartsController extends BackendController
{

    protected $partsRepository;

    /**
     * PartsController constructor.
     * @param $partsRepository
     */
    public function __construct(PartsRepository $partsRepository)
    {
        $this->partsRepository = $partsRepository;
    }

    public function getAll()
    {
        return $this->partsRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }

    public function add()
    {
        return view('admin.parts_management.elements.modal_add_update_parts');
    }

}
