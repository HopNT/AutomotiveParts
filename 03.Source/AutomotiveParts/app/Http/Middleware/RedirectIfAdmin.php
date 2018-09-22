<?php

namespace App\Http\Middleware;

use App\Http\Common\DAO\MenuDAO;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'admin')
	{
	    if (Auth::guard($guard)->check()) {
                $routeName = $this->getDefaultPage(Auth::guard($guard)->user());
	        return redirect(route($routeName));
	    }
	    return $next($request);
	}
        
        /**
     * get default page of user
     */
    private function getDefaultPage($staff) {
        $alowMenu = (new MenuDAO())->getAllBy($staff);
        foreach ($alowMenu as $menu) {
            if (!empty($menu->parent_id)) {
                return $menu->route_name;
            }
        }
        return 'admin_home';
        
    }
}
