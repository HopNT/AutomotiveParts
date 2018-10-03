<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/19/2018
 * Time: 09:11
 */
namespace App\Http\Controllers\Admin;

use App\Http\Common\Entities\TradeMark;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\TradeMarkRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TradeMarkManagementController extends BackendController
{
    protected $tradeMarkRepository;

    /**
     * TradeMarkManagementController constructor.
     * @param $tradeMarkRepository
     */
    public function __construct(TradeMarkRepository $tradeMarkRepository)
    {
        $this->tradeMarkRepository = $tradeMarkRepository;
    }

    public function index()
    {
        $listTradeMark = $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        return view('admin.trademark_management.trademark_management')
            -> with('listTradeMark', $listTradeMark);
    }

    public function getById(Request $request)
    {
        $tradeMarkId = $request->id;
        $tradeMark = $this->tradeMarkRepository->find($tradeMarkId);
        return [
            'data' => $tradeMark
        ];
    }

    public function save(Request $request)
    {
        $valid = new TradeMark();
        $tradeMark = $request->all();
        try
        {
            if (isset($request->trademark_id)) {
                $this->tradeMarkRepository->merge($request->trademark_id, $tradeMark);
            } else {
                $validator = Validator::make($tradeMark, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                $tradeMark = array_add($tradeMark, 'status', GlobalEnum::STATUS_ACTIVE);
                $this->tradeMarkRepository->persist($tradeMark);
            }
        }
        catch(\Exception $e)
        {
            return [
                'system_error' => true,
                'message_error' => $e->getMessage()
            ];
        }

        // Get List nation
        $listTradeMark = $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.trademark_management.elements.list_data_trademark')
            ->with('listTradeMark', $listTradeMark)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->tradeMarkRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List trademark
        $listTradeMark = $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.trademark_management.elements.list_data_trademark')
            ->with('listTradeMark', $listTradeMark)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getAll()
    {
        return $this->tradeMarkRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }

}
