<?php

namespace App\Http\Middleware;

use Closure;

class SessionTimeout
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
        // session()->forget('lastActivityTime');

        if (! session()->has('lastActivityTime')) {
            session(['lastActivityTime' => now()]);
        }


        if (now()->diffInMinutes(session('lastActivityTime')) >= config('session.lifetime') ) {  // also you can this value in your config file and use here
            if (auth()->check()) {
               \App\User::whereId(auth()->id())->update(['session_id' => null]);
                auth()->logout();
                session()->forget('lastActivityTime');
                return redirect(url('/'));
            }
     
        }

       session(['lastActivityTime' => now()]);

       return $next($request);
    }
}
