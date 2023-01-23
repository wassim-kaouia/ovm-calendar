<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAssistant
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == 'assistant' || Auth::user()->role == 'superviseur' || Auth::user()->role == 'webmaster' || Auth::user()->role == 'admin' ){
            return $next($request);
        }
        return redirect('/');
    }
}
