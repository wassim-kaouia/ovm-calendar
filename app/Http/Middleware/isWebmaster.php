<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isWebmaster
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'webmaster' || Auth::user()->role == 'superviseur' || Auth::user()->role == 'vendeur' || Auth::user()->role == 'admin' || Auth::user()->role == 'assistant'){
            return $next($request);
        }
        return redirect('/');
    }
}