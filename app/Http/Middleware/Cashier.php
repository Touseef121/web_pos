<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Cashier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if (Auth::user()->role === 'cashier') {
                return $next($request);
            }else{
                return redirect()->route("login.page")->with('error', 'Log in as Cashier. You are not a Cashier!');
            }
        }else{
           return redirect()->route('home');
        }
    }
}
