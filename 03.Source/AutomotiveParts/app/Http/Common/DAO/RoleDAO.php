<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/5/2018
 * Time: 1:51 AM
 */

namespace App\Http\Common\DAO;


use App\Http\Common\Entities\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class RoleDAO extends Role
{
    /**
     * key for store cache of menu that apply for all staff same role
     */
    const KEY_FOR_CACHE_ALL = 'Role_Get_All';



    /**
     * clear cache by get all
     * @param type $role_id
     */
    public static function clearCacheByGetAll($role_id){
        $key = self::KEY_FOR_CACHE_ALL;
        Cache::forget($key);
        //clear cache for get menu by role
        if(!empty($role_id)){
            MenuDAO::clearCacheByRole($role_id);
        }

    }
    public function getAllRoles(){
        $data = DB::table('tbl_role')->get();
        return $data;
    }

    /**
     * get role by id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function getRoleById($id){
        $data = Role::find($id);
        return $data;
    }

    /**
     * delete role by id
     * @param $id
     * @return bool|int|null
     * @throws \Exception
     */
    public function deleteRoleById($id){
        $role = $this->getRoleById($id);
        $delete = $role->delete();
        return $delete;
    }
    /**
     * add new role
     * @param type $newRole
     * @param type $page_list
     * @return boolean
     */
    public function addRole($newRole, $page_list){
        DB::beginTransaction();
        try {
            $newRole->save();

            $newRole->menus()->attach($page_list);
            DB::commit();
            //clear cache for apply new infor
            self::clearCacheByGetAll($newRole->id);
            return '';
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * get list menu id by role
     * @param type $role_id
     * @return type
     */
    public function getMenuList($role_id){
        $result = DB::table('tbl_role as role')
            ->leftjoin('tbl_menu_role as mn', ['mn.role_id' => "role.id"])
            ->where(['role.id'=>$role_id])
            ->pluck('menu_id','menu_id')
            ->toArray();
        return $result;
    }

    /**
     * add new role
     * @param type $role
     * @param type $page_list
     * @return boolean
     */
    public function updateRole($role, $page_list){
        DB::beginTransaction();
        try {

            $role->save();

            $role->menus()->sync($page_list);

            DB::commit();
            //clear cache for apply new infor
            self::clearCacheByGetAll($role->id);
            return '';
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
