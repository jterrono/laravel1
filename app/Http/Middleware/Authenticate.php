<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        

        if(empty($_SERVER['HTTP_API_USERNAME']) || empty($_SERVER['HTTP_API_KEY']))
        {
            return response('Unauthorized.', 401);
        }
        

        $arr = array(
            'email' => $_SERVER['HTTP_API_USERNAME'],
            'password' => ($_SERVER['HTTP_API_KEY'])
            //'password' => '$2y$10$5Mns5O.GOa5kYVwhi.nxSOK3um2pqlEWfA5bqKoRpaAqA.bve80ni'
        );

        Auth::attempt($arr);

        if(!Auth::check())
        {
            return response('Unauthorized.', 401);
        }

        
        /*
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        */
        return $next($request);
    }
}
