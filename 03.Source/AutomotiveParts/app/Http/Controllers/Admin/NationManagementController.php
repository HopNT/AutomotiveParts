<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/9/2018
 * Time: 3:47 PM
 */
namespace  App\Http\Controllers\Admin;

use App\Http\Common\Entities\Nation;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Repository\NationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NationManagementController extends BackendController{

    protected $nationRepository;

    /**
     * NationManagementController constructor.
     * @param $nationRepository
     */
    public function __construct(NationRepository $nationRepository)
    {
        $this->nationRepository = $nationRepository;
    }

    public function index()
    {
        $listNation = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        return view('admin.nation_management.nation_management')
            ->with('listNation', $listNation);
    }

    public function getById(Request $request)
    {
        $nationId = $request->id;
        $nation = $this->nationRepository->find($nationId);
        return [
            'data' => $nation
        ];
    }

    public function save(Request $request)
    {
        $valid = new Nation();
        $nation = $request->all();
        try
        {
            if (isset($request->nation_id)) {
                $this->nationRepository->merge($request->nation_id, $nation);
            } else {
                $validator = Validator::make($nation, $valid->rules, [], $valid->attributes);
                if ($validator->fails()) {
                    return [
                        'error' => true,
                        'errors' => $validator->errors()
                    ];
                }
                $nation = array_add($nation, 'status', GlobalEnum::STATUS_ACTIVE);
                $this->nationRepository->persist($nation);
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
        $listNation = $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.nation_management.elements.list_data_nation')
            ->with('listNation', $listNation)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            $this->nationRepository->deleteMulti($ids);
        }
        catch (\Exception $e)
        {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }

        // Get List nation
        $listNation = $this->nationRepository->getAll()->where('status', GlobalEnum::STATUS_ACTIVE);
        $view = view('admin.nation_management.elements.list_data_nation')
            ->with('listNation', $listNation)->render();
        return [
            'error' => false,
            'html' => $view
        ];
    }

    public function getAll()
    {
        return $this->nationRepository->getAll()->where('status', '=', GlobalEnum::STATUS_ACTIVE);
    }
}
