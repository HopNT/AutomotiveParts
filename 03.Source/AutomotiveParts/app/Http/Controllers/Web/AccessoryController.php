<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 10/20/2018
 * Time: 2:54 PM
 */

namespace App\Http\Controllers\Web;


use App\Http\Common\Repository\AccessaryLinkRepository;
use App\Http\Common\Repository\AccessaryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{

    protected $accessaryRepository;

    protected $accessaryLinkRepository;

    /**
     * AccessoryController constructor.
     * @param $accessaryRepository
     */
    public function __construct(AccessaryRepository $accessaryRepository, AccessaryLinkRepository $accessaryLinkRepository)
    {
        $this->accessaryRepository = $accessaryRepository;
        $this->accessaryLinkRepository = $accessaryLinkRepository;
    }

}
