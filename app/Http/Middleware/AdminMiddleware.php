<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $roles = Role::all()->pluck('id')->toArray();
            if (in_array(Auth::user()->role_as, $roles)) {
                return $next($request);
            } else {
                return redirect('/home')->with('status', 'Access Denied! You do not have the required permissions.');
            }
        } else {
            return redirect('/home')->with('status', 'Please Login First');
        }
    }
}
