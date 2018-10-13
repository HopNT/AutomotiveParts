<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/5/2018
 * Time: 1:53 AM
 */

namespace App\Http\Controllers\Admin;


use App\Http\Common\DAO\MenuDAO;
use App\Http\Common\DAO\RoleDAO;
use App\Http\Common\DAO\UserDAO;
use App\Http\Common\Entities\Role;
use App\Http\Common\Entities\UserDb;
use App\Http\Common\Enum\GlobalEnum;
use App\Http\Common\Utils\CommonUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AccountManagementController extends BackendController
{
    public function index(){
        $lst_user = (new UserDAO())->getAllUser();
        $lst_role = (new RoleDAO())->getAllRoles();
        $data_role = (new RoleDAO())->getDataRole(true);
        return view('admin.account_management.account_management')
            ->with('lst_users',$lst_user)
            ->with('lst_role',$lst_role)
            ->with('data_role',$data_role);
    }

    public function addRole(){
        $page_list = (new MenuDAO())->getMenuRole();

        if(request()->isMethod("post")){
            $newRole = new Role();
            $newRole->fill(request()->all());
            $validator = Validator::make(request()->all(), $newRole->rules, $newRole->messages);
            if ($validator->fails()) {
                return ['errors' => $validator->errors(),
                    'error' => true
                ];
            }
            $page = request()->get('mn_selected_list');
            $page_list = array_keys($page);

            //unset temp field
            unset($newRole->mn_selected_list);
            $msgResult = (new RoleDAO())->addRole($newRole, $page_list);
            //save error
            if(!empty($msgResult)){
                return ['message' => $msgResult,
                    'error' => true,

                ];
            }

            return ['message' => 'Create new role successfully.',
                'error' => false,
                'url' => route('account-management')
            ];
        }

        return view('admin.account_management.elements.add_role')
            ->with('pageList',$page_list)
            ->with('role',new Role());
    }

    /**function edit role and update role
     * @return type|array
     */
    public function editRole(){
        $role_id = request()->get('id');
        $role = RoleDAO::find($role_id);
        if(!$role){
            return $this->error404();
        }
        if(request()->isMethod("post")){
            $role->fill(request()->all());
            $validator = Validator::make(request()->all(), $role->rules_update, $role->messages);
            if ($validator->fails()) {
                return ['errors' => $validator->errors(),
                    'error' => true
                ];
            }

            //unset temp field
            unset($role->mn_selected_list);
            //update role
            $page = request()->get('mn_selected_list');

            $page_list = array_keys($page);
            $msgResult = (new RoleDAO())->updateRole($role, $page_list);
            //save error
            if(!empty($msgResult)){
                return ['message' => $msgResult,
                    'error' => true
                ];
            }
            return ['message' => 'Update role successfully.',
                'error' => false,
                'url' => route('account-management')
            ];

        }

        $key_search = '';
        $page_all = '';
        $page_list = (new MenuDAO())->getMenuRole();
        $page_selected = (new RoleDAO())->getMenuList($role_id);
        return view("admin.account_management.elements.edit_role")
            ->with('pageList', $page_list)
            ->with('key_search', $key_search)
            ->with('page_all', $page_all)
            ->with('pageSelected', $page_selected )
            ->with('role', $role);
    }

    /**
     * function save new role to db
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function saveNewRole(Request $request){
        if ($request->isMethod('post')) {
            $role = new Role();
            $validator = Validator::make($request->all(), $role->rules, $role->messages);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }
            if(isset($request->role_id)){
                $role = (new RoleDAO())->getRoleById($request->role_id);
                $role->role_name = $request->role_name;
                $role->description = $request->description;
                $role->updated_at = date("Y-m-d H:i:s");
                $role->save();
            }else{
                //save role
                $role->fill($request->all());
                $role->save();
            }

            //show data
            $lst_role = (new RoleDAO())->getAllRoles();
            $view = view('admin.account_management.elements.list_data_role')
                ->with('lst_role',$lst_role)->render();
            return [
                'error' => false,
                'html' => $view,
                'message' => trans('label.common.success')
            ];
        }
    }

    /**function get role by id
     * @param Request $request
     * @return array
     */
    public function getRole(Request $request){
        $role_id = $request->id;
        if($role_id && is_numeric($role_id)){
            $data = (new RoleDAO())->getRoleById($role_id);
            if($data){
                return [
                    'error' => false,
                    'data' => $data
                ];
            }
            return [
                'error' => true,
            ];
        }
    }

    /**
     * function delete role by id
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function deleteRole(Request $request){
        $role_id = $request->id;
        if($role_id && is_numeric($role_id)){
            $role = (new RoleDAO())->getRoleById($role_id);
            $deletedRows = $role->delete();
            if($deletedRows){
                //show data
                $lst_role = (new RoleDAO())->getAllRoles();
                $view = view('admin.account_management.elements.list_data_role')
                    ->with('lst_role',$lst_role)->render();
                return [
                    'error' => false,
                    'html' => $view,
                    'message' => trans('label.common.success')
                ];
            }
            return [
                'error' => true,
                'message' => trans('label.common.error')
            ];
        }

    }

    /**
     * function save new role to db
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function saveNewUser(Request $request){
//        dd($request->all());
        if ($request->isMethod('post')) {
            $user = new UserDb();
            $validator = Validator::make($request->all(), $user->rules, $user->messages);
//            dd($validator->errors());
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }
            if(isset($request->user_id)){
                $user = (new UserDAO())->getUserById($request->user_id);
                if($user){
                    $user->name = $request->name;
                    $user->birth_day = $request->birth_day;
                    $user->gender = $request->gender;
                    $user->phone_number = $request->phone_number;
                    $user->role_id = $request->role_id;
                    $user->user_type = $request->user_type;
                    $user->fax = $request->fax;
                    $user->identify_card = $request->identify_card;
                    $user->driving_license = $request->driving_license;
                    $user->address = $request->address;
                    $user->updated_at = date("Y-m-d H:i:s");
                    $user->save();
                }
            }else{
                $data = $request->all();
                if ($request->hasFile('avatar'))
                {
                    $pathAvatar = CommonUtils::uploadFile($request->avatar, 'user', GlobalEnum::IMAGE);
                    unset($data['avatar']);
                    $data = array_add($data, 'avatar', $pathAvatar);
                    $data = array_add($data, 'avatar_name', $request->avatar->getClientOriginalName());
                }
                //save role
                $user->fill($data);
//                dd($user);
                $user->status = GlobalEnum::STATUS_ACTIVE;
                $user->password = bcrypt('123456');
                $user->save();
            }

            //show data
            $lst_user = (new UserDAO())->getAllUser();
            $data_role = (new RoleDAO())->getDataRole(true);
            $view = view('admin.account_management.elements.list_data_user')
                ->with('lst_users',$lst_user)
                ->with('data_role',$data_role)
                ->render();
            return [
                'error' => false,
                'html' => $view,
                'message' => trans('label.common.success')
            ];
        }
    }

    /**function get User by Id
     * @return type|array
     */
    public function getUser(){
        $user_id = request()->get('id');
        $user = UserDAO::find($user_id);
        if(!$user){
            return $this->error404();
        }
        return [
            'error'=>false,
            'data_user' => $user
        ];
    }

    /**
     * function delete user by id
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function deleteUser(Request $request){
        $user_id = $request->id;
        if($user_id && is_numeric($user_id)){
            $user = (new UserDAO())->getUserById($user_id);
            $deletedRows = $user->delete();
            if($deletedRows){
                //show data
                $lst_user = (new UserDAO())->getAllUser();
                $data_role = (new RoleDAO())->getDataRole(true);
                $view = view('admin.account_management.elements.list_data_user')
                    ->with('lst_users',$lst_user)
                    ->with('data_role',$data_role)->render();
                return [
                    'error' => false,
                    'html' => $view,
                    'message' => trans('label.common.success')
                ];
            }
            return [
                'error' => true,
                'message' => trans('label.common.error')
            ];
        }

    }

    public function viewProfile(Request $request){
        if($request->isMethod('post')){
            $user = new UserDb();
            $validator = Validator::make($request->all(), $user->rule_update_profile, $user->messages);
            if ($validator->fails()) {
                return [
                    'error' => true,
                    'errors' => $validator->errors()
                ];
            }
            if(isset($request->user_id)){
                $user = (new UserDAO())->getUserById($request->user_id);
                $avatar = '';
                if ($request->hasFile('avatar'))
                {
                    if (!empty($request->avatar) && $user->avatar)
                    {
                        File::delete($user->avatar);
                    }
                    $avatar = CommonUtils::uploadFile($request->avatar, 'user/avatar/'.$user->user_id, GlobalEnum::IMAGE);
                }
                $user->name = $request->name;
                $user->birth_day = $request->birth_day;
                $user->gender = $request->gender;
                $user->phone_number = $request->phone_number;
                $user->fax = $request->fax;
                $user->identify_card = $request->identify_card;
                $user->driving_license = $request->driving_license;
                $user->address = $request->address;
                if($avatar){
                    $user->avatar = $avatar;
                }
                $user->updated_at = date("Y-m-d H:i:s");
                $user->save();
            }
            return [
                'error' => false,
                'message' => trans('label.common.success')
            ];
        }
        $user = Auth::guard('admin')->user();
        $data_role = (new RoleDAO())->getDataRole(true);
        return view('admin.auth.view_profile')
                    ->with('data_role',$data_role)
                    ->with('user',$user);
    }


}
