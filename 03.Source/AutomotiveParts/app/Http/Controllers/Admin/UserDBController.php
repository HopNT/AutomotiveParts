<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 10/27/2018
 * Time: 12:00 PM
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\UserRepository;
use Illuminate\Http\Request;

class UserDBController extends BackendController {

    protected $userRepository;

    /**
     * UserDBController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function searchByText(Request $request) {
        $result = array();
        $text = $request->get('query');
        if(empty($text)) {
            $listUser = $this->userRepository->getAll()->where('user_type', '=', GlobalEnum::PROVIDER);
        } else {
            $listUser = $this->userRepository->searchByText($text);
        }

        $index = 0;
        if (!empty($listUser)) {
            foreach ($listUser as $item) {
                $result[$index]['id'] = $item->user_id;
                $result[$index]['text'] = $item->name;
                $index++;
            }
        }

        return [
            'items' => $result
        ];
    }

}
