<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class HomeController extends Controller
{
//    protected $iHangXeRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getAll()
    {
//        $hangXe = $this->iHangXeRepository->getAll();
//        dd($hangXe);
//        return $hangXe;
        dd(\Illuminate\Support\Facades\DB::table('dm_hangxe')->get());
    }
}
