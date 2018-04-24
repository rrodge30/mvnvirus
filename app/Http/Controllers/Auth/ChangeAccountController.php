<?php

namespace App\Http\Controllers\Auth;

use auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeAccountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('auth/change-account-info');
    }

    public function changeAccount(Request $request){
        if($request->password !== $request->password_confirmation){
            return redirect()->route('user.change.account')->withError('Passwords does not match');
        }

        if(strlen($request->password) < 6){
            return redirect()->route('user.change.account')->withError('Password must be minimum of 6 characters');
        }

        $checkNewAccount = DB::table('table_users')->where('id','!=',Auth::user()->id)
                                                    ->where('username',$request->username)
                                                    ->first();
        if($checkNewAccount){
            return redirect()->route('user.change.account')->withError('User Already Exist');
        }                                                    

        $newUser = array(
            "id" => Auth::user()->id,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'email'=>$request->username . '@' . $request->username . '.com',
            'user_level'=>Auth::user()->user_level,
            "remember_token" => null,
            'created_at'=>Auth::user()->created_at,
            'updated_at'=>Auth::user()->updated_at,
        );

        $isUpdated = DB::table('table_users')
                    ->where('id',Auth::user()->id)
                    ->update($newUser);
        if($isUpdated){

            Auth::attempt($newUser);
            return redirect()->route('home')->withSuccess('Your Account has been Updated');
        }else{
            return redirect()->route('user.change.account')->withError('Failed To Update Your Account');
        }
    }
}
