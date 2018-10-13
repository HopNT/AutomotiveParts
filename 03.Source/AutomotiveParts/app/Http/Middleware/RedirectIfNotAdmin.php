<?php

namespace App\Http\Middleware;

use App\Http\Common\Helper\DataHelper;
use App\Http\Common\DAO\MenuDAO;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class RedirectIfNotAdmin
{
    private $exclude = ["admin_reset_pw", "admin_post_reset_pw", "admin_logout", "admin_login", "admin_post_login"];
    private $excludeMySetting = ["my_setting", "my_setting_reset_pw"];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        $isAuth = true;
        $router_name = Route::currentRouteName();
        if (!Auth::guard($guard)->check()) {
            if (!in_array($router_name, $this->exclude)) {
                //check if request ajax then return code 401.
                //ajax main check code and redirect to login
                if (Request::ajax()) {
                    return response()->json(['error' => 'Unauthenticated.'], 401);
                }
                return redirect(route('admin_login'));
            }
            $isAuth = false;
        }
        //process check permistion
        if ($isAuth && !in_array($router_name, $this->exclude)) {
            $user = Auth::guard($guard)->user();
            $role_id = $user->role_id;
            if (!isset($user->permistions)) {
                $permistions = (new MenuDAO())->getPermistons($role_id);
                $user->permistions = $permistions;
            }
            if(!in_array($router_name, $this->excludeMySetting)){
                $can_view = $user->can_view($router_name);
                if(!$can_view){
                    if(Request::ajax()){
                        return response()->json(['error' => 'You are not permission!'], 403);
                     }
                    abort(403, "You are not permission!");
                }
            }
        }
        if(Auth::guard($guard)->check()){
            $menu = (new DataHelper())->loadLeftNavData();
            View::share('leftMenu',$menu);
//            dd($menu);
        }
        return $next($request);
    }
}
