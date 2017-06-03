<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserAlreadyLogin
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
        if(Auth::check()) //if user already login
        {
            $message_warning = ['message_warning' => 'You are already logged in.'];
            return redirect()->route('home')->with($message_warning);
        }

        return $next($request);
    }
}
