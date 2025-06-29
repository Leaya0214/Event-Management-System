<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('client')->check()){
            if (Auth::guard('client')){
                return $next($request);
            }
            else{
                return redirect()->route('client.login')->with('message','Access Denied! you are not User.');
            }
        }
        else{
            return redirect()->route('client.login')->with('message','Please login first !');
        }
    }
}
