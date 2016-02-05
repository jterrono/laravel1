<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        //dd($_SERVER);

        $arr = array(
            'email' => $_SERVER['HTTP_API_USERNAME'],
            'api_key' => $_SERVER['HTTP_API_KEY']
        );

        dd($arr);
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
