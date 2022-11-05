<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, String $role)
    {
        if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
            return redirect('/dashboard');

        $user = Auth::user();
        if($user->role == $role){
            return $next($request);
        }

        return redirect('/dashboard')->withError("You are not authorized");
    }
}
