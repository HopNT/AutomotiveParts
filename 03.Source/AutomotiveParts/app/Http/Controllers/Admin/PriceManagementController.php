<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:21
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\UserAccessary;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PriceManagementController extends BackendController
{
    protected $userRepository;

    protected $accessaryRepository;

    /**
     * PriceManagementController constructor.
     * @param $userRepository
     * @param $accessaryRepository
     */
    public function __construct(UserRepository $userRepository, AccessaryRepository $accessaryRepository)
    {
        $this->userRepository = $userRepository;
        $this->accessaryRepository = $accessaryRepository;
    }

    public function index()
    {
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listPrice = $this->userRepository->getAllJoinDataWithAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listPrice = $this->userRepository->getAllJoinDataWithProductProvider($user->user_id);
        }
        return view('admin.price_management.price_management')
            ->with('listPrice', $listPrice);
    }

    public function save(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $valid = new UserAccessary();
        $price = $request->all();
        try {
            // Update
            if ($user->user_type !== GlobalEnum::ADMIN) {
                $user_id = $request->user_id;
            } else {
                $user_id = $user->user_id;
            }

            $user = $this->userRepository->find($user_id);
            if (isset($request->user_accessary_id))
            {
                $user->accessarys()->sync([$price['accessary_id'] => ['garage_price' => $price['garage_price'], 'retail_price' => $price['retail_price'], 'quantity' => $price['quantity'], 'status' => $price['status'], 'updated_at' => now()]], false);
            }
            else // Insert
            {
                $validator = Validator::make($price, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                $user->accessarys()->attach($price['accessary_id'], ['garage_price' => $price['garage_price'], 'retail_price' => $price['retail_price'], 'quantity' => $price['quantity'], 'status' => GlobalEnum::STATUS_ACTIVE, 'created_at' => now(), 'updated_at' => now()]);
            }
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        // Get List Price
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listPrice = $this->userRepository->getAllJoinDataWithAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listPrice = $this->userRepository->getAllJoinDataWithProductProvider($user->user_id);
        }
        $view = view('admin.price_management.elements.list_data_price')
            ->with('listPrice', $listPrice)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getById(Request $request)
    {
        $userAccessaryId = $request->id;
        $price = $this->userRepository->getPrice($userAccessaryId);
        $user = $this->userRepository->find($price->all()[0]->user_id);
        $accessary = $this->accessaryRepository->find($price->all()[0]->accessary_id);
        return [
            'user' => $user,
            'data' => $price->all()[0],
            'accessary' => $accessary
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->userRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List Price
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $listPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listPrice = $this->userRepository->getAllJoinDataWithAdmin();
        }
        if ($userType == GlobalEnum::PROVIDER)
        {
            $listPrice = $this->userRepository->getAllJoinDataWithProductProvider($user->user_id);
        }
        $view = view('admin.price_management.elements.list_data_price')
            ->with('listPrice', $listPrice)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

}
