<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserPermission {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);

        $nameClass = substr($controller, 0, -10);
        $nameMethod = app('request')->route()->getActionMethod();

        if (!Auth::user()->can($nameClass . '.' . $nameMethod)) {
            if(request()->ajax()):
                return response()->json(['error' => 'Unauthorised'], 401);
            endif;
            abort('401');
        }
        return $next($request);
    }

}
