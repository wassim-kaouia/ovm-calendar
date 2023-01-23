<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isVendor
{
   
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'vendeur' || Auth::user()->role == 'superviseur' || Auth::user()->role == 'admin'){
            return $next($request);
        }
        return redirect('/');
    }
}
