<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {
        if (Auth::user()->is_admin) {
            return $next($request);
        } else {
            return redirect("/")->withMyerror("You are not authorized for this action");
        }
    }
}
