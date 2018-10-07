<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/25/2018
 * Time: 01:51
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\AccessaryRepository;
use Illuminate\Http\Request;

class AccessaryManagementController extends BackendController
{
    protected $accessaryRepository;

    /**
     * AccessaryManagementController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
    }

    public function index()
    {

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

    public function getAll()
    {
        return $this->accessaryRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }

}
