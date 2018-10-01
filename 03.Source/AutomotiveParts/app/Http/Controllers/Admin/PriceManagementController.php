<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:21
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Common\Repository\UserRepository;

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

}
