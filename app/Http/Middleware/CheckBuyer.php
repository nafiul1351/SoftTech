<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBuyer
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
        if(auth()->user()->type == 'Admin'){
            return redirect()->route('admin.home');
        }
        else if(auth()->user()->type == 'Seller'){
            return redirect()->route('seller.home');
        }
        else if(auth()->user()->type == 'Buyer'){
            return $next($request);
        }
    }
}
