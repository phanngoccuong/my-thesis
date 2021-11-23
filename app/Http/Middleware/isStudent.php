<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isStudent
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
        if (!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::user()->role_name == 'Admin') {
            return redirect('/admin/home');
        }
        if (Auth::user()->role_name == 'Student') {
            return $next($request);
        }
        if (Auth::user()->role_name == 'Teacher') {
            return redirect('/teacher/home');
        }
    }
}
