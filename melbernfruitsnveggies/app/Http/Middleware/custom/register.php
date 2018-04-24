<?php

namespace App\Http\Middleware\custom;

use Closure;

use Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class register
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
        $admin = DB::table('table_users')->where('user_level','99')->count();
        if($admin > 0){
            if(Auth::check()){ //CHECK IF USER LOGGED IN
                if(Auth::user()->user_level != "99"){ // CHECK USER LOG IF NOT ADMIN
                    return redirect()->route('login')->withError('Unauthorize User');
                }
            }else{
                return redirect()->route('login')->withError('Unauthorize User');
            }
        }
        
        return $next($request);
    }
}
