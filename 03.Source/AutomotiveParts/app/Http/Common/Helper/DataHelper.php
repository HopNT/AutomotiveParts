<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/24/2018
 * Time: 12:10 AM
 */

namespace App\Http\Common\Helper;


use App\Http\Common\DAO\MenuDAO;
use Illuminate\Support\Facades\Auth;

class DataHelper
{
    /**function get all menu
     * @return array
     */
    public function loadLeftNavData(){
        $path = request()->path();
        $is_admin = $this->isAdminModule($path);
        $menus = [];
        if($is_admin) {
            $leftNav = (new MenuDAO())->getAllBy(Auth::guard('admin')->user());
            for ($i = 0; $i < count($leftNav); $i++) {
                $menuParent = $leftNav[$i];
                if (empty($menuParent->parent_id)) {
                    array_push($menus, $menuParent);
                }
            }
        }
        return $menus;
    }

    /**
     * check throwException from module admin or client
     * @param type $path
     * @return boolean
     */
    private function isAdminModule($path){
        //check request admin not use subdomain
        $modules = explode('/', $path);
        if($modules[0] == 'admin'){
            return true;
        }
        return false;
    }
}
