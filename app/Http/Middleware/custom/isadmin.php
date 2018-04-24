<?php

namespace App\Http\Middleware\custom;

use Closure;

use Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class isadmin
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
        if(Auth::check()){
            if(Auth::user()->user_level != "99"){
                return redirect()->route('home')->withError('Unauthorize User');
            }
        }else{
            return redirect()->route('login')->withError('Unauthorize User');
        }
        return $next($request);
    }
}
