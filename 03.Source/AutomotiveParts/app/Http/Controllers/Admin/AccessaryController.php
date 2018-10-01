<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/25/2018
 * Time: 01:51
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Repository\AccessayRepository;
use Illuminate\Http\Request;

class AccessaryController extends BackendController
{
    protected $accessaryRepository;

    /**
     * AccessaryController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessayRepository $accessaryRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
    }

    public function searchByText(Request $request)
    {
        $result = array();
        $text = $request->get('query');
        $listAccessary = $this->accessaryRepository->searchByText($text);
        $index = 0;
        if (!empty($listAccessary))
        {
            foreach ($listAccessary as $item) {
                $result[$index]['id'] = $item->accessary_id;
                $result[$index]['text'] = $item->code.' - '.$item->name_vi;
                $index++;
            }
        }
        return [
            'items' => $result
        ];
    }

}
