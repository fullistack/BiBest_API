<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $allowedRoles = array_slice(func_get_args(), 2);
        if(Auth::check() && in_array(Auth::user()->role(),$allowedRoles)){
            return $next($request);
        }
        return response()->json("403 forbidden",403);
    }
}
