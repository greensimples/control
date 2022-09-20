<?php

 

namespace App\Http\Middleware;

 

use App\Providers\RouteServiceProvider;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

 

class RedirectIfAuthenticated

{

    public function handle(Request $request, Closure $next, ...$guards)

    {

        $guards = empty($guards) ? [null] : $guards;

 

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                if (Auth::guard($guard)->user()->role == 1) {

                    return redirect(RouteServiceProvider::ADMIN_HOME);

                } else {

                    return redirect(RouteServiceProvider::HOME);

                }

            }

        }

 

        return $next($request);

    }

}

 

