<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userRoles = Auth::user()->role()->pluck('name');
        if(!$userRoles->contains('admin')){
            Session::flash('status', 'Access denied');
            return redirect('/home');
        }
        
        return $next($request);
    }
}
