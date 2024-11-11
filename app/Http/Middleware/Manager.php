<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if (Auth::user()->role === 'manager') {
                return $next($request);
            }else{
                return redirect()->route("login.page")->with('error', 'Login as Manager. You are not a Manager!');
            }
        }else{
           return redirect()->route('home');
        }
    }
}
