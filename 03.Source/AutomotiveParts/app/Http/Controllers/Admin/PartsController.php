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
use Illuminate\Http\Request;

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

    public function searchByText(Request $request)
    {
        $results = array();
        $text = $request->get('query');
        $listParts = $this->partsRepository->searchByText($text);
        $index = 0;
        if (!empty($listParts))
        {
            foreach ($listParts as $key => $parts)
            {
                $results[$index]['id'] = $parts->parts_id;
                $results[$index]['text'] = $parts->code.' - '.$parts->name;
                $index++;
            }
        }
        return [
            'items' => $results
        ];
    }

}
