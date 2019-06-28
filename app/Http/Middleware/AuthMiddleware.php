<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if(auth()->guest()){
            session()->flash('message', 'You have to log in first..!!');
            return redirect()->route('login');
        }
        return $next($request);
    }


}
