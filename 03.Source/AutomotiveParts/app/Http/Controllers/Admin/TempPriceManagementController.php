<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/03/2018
 * Time: 10:05
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\TempPriceRepository;
use App\Http\Common\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TempPriceManagementController extends BackendController
{
    protected $tempPriceRepository;

    protected $userRepository;

    protected $accessaryRepository;

    /**
     * TempPriceManagementController constructor.
     * @param $tempPriceRepository
     * @param $userRepository
     * @param $accessaryRepository
     */
    public function __construct(TempPriceRepository $tempPriceRepository, UserRepository $userRepository, AccessaryRepository $accessaryRepository)
    {
        $this->tempPriceRepository = $tempPriceRepository;
        $this->userRepository = $userRepository;
        $this->accessaryRepository = $accessaryRepository;
    }

    public function index()
    {
        $user = Auth::guard('admin')->user();
        $userType = $user->user_type;
        $userId = $user->user_id;
        $listTempPrice = null;
        if ($userType == GlobalEnum::ADMIN)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByAdmin();
        }
        if ($userType == GlobalEnum::USER)
        {
            $listTempPrice = $this->tempPriceRepository->getAllByProductProvider($userId);
        }
        return view('admin.temp_price_management.temp_price_management')
            ->with('listTempPrice', $listTempPrice);
    }

    public function getById(Request $request)
    {

    }

    public function save(Request $request)
    {

    }

    public function approve(Request $request)
    {

    }

    public function reject(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }

}
