<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Common\DAO\UserDAO;
use App\Http\Common\Entities\UserDb;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $user = new UserDb();
            $validator = Validator::make($request->all(), $user->rule_update_password, $user->messages);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }
            $curPassword = $request->old_password;
            $newPassword = $request->password;
            $user = Auth::guard('admin')->user();
            if (Hash::check($curPassword, $user->password)) {
                $user_id = Auth::guard('admin')->user()->user_id;
                $obj_user = (new UserDAO())->getUserById($user_id);
                $obj_user->password = Hash::make($newPassword);
                $obj_user->save();

                return [
                    'error' => false,
                    'message' => trans('label.common.success')
                ];
            }
            else
            {
                return [
                    'error' => false,
                    'message' => trans('label.common.error')
                ];
            }

        }
    }


}
