<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/9/2018
 * Time: 3:47 PM
 */
namespace  App\Http\Controllers\Admin;

use App\Http\Common\Repository\NationRepository;
use App\Http\Controllers\Controller;

class NationManagementController extends Controller{

    protected $nationlRepository;

    public function __construct(NationRepository $nationRepository)
    {
        $this->nationlRepository = $nationRepository;
    }

    public function index(){
        $listNation = $this->nationlRepository ->getAll();
        // dd($listNation);
        return view('admin.nation_management.nation_management', compact('listNation'));
        //return view('admin.nation_management.nation_management').with('listNation',$listNation);
    }
}