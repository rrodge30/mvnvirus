<?php

namespace App\Http\Middleware\custom;

use Closure;

use Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class hasadmin
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
        if(!Auth::check()){ //ONLY CHECK FOR ADMINS IF USER NOT LOGGED
            if($request->path() != "register"){
                if(DB::table('table_users')->where('user_level','99')->count() === 0){ //TRUE IF NO ADMIN REGISTERED
                    return redirect(route('register'));
                }else{
                    if($request->path() != "login"){
                        return redirect(route('login'));
                    }
                }
            }   
            
        }
        return $next($request);
    }
}
