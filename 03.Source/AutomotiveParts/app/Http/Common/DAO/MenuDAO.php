<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/11/2018
 * Time: 9:57 AM
 */

namespace App\Http\Common\DAO;


use App\Http\Common\Entities\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MenuDAO extends Menu
{
    const KEY_FOR_CACHE_ALL = 'Menu_Get_All_By_Role_Id_';

    /**
     * clear cache by role
     * @param type $role_id
     */
    public static function clearCacheByRole($role_id){
        $key = self::KEY_FOR_CACHE_ALL . $role_id;
        Cache::forget($key);
    }
    /**
     *
     * @param type $user
     * @return type
     *
     */
    public function getAllBy($user) {//add where late
        if ($user) {
            $minutes = self::$duration/60;
            $role_id = $user->role_id;
            $key = self::KEY_FOR_CACHE_ALL . $role_id;
            $value = Cache::remember($key, $minutes, function() use($role_id){
                $data = DB::table($this->table.' as mn')
                    ->select('mn.*')
                    ->leftjoin('tbl_menu_role as mr', 'mr.menu_id', '=', 'mn.id')
                    ->where(['mn.is_menu' => '1', 'mr.role_id' => $role_id])
                    ->orderby('mn.display_order', 'asc')
                    ->get()
                    ->toArray();
                return $data;
            });
            return $value;
        }
        return [];
    }

    /**
     * get all permision of role
     * @param type $role_id
     * @return type
     */
    public function getPermistons($role_id) {
        $data = DB::table($this->table.' as mn')
            ->select("mn.id","mn.function_name","mn.event_id","mn.menu_url","mn.route_name")
            ->join('tbl_menu_role AS role', 'role.menu_id', '=', 'mn.id')
            ->where(['role.role_id' => $role_id])
            ->orderby('display_order','asc')
            ->get()
            ->toArray();
        return $data;
    }

    /**
     * get all menu and childs
     * @return type
     */
    public function getMenuRole() {

        $data = Menu::with('pages')
            ->where(['is_menu' => '1', 'parent_id'=>0])
            ->orderby('display_order','asc')
            ->get();
        return $data;
    }
}
