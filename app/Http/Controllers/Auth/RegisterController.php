<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $checkUserExist = DB::table('table_users')->where('username',$data["username"])->first();
        if($checkUserExist){
            return redirect()->route('register')->withError('User Already Exists');
        }

        if(Auth::check()){
                $user = array(
                'username' => $data['username'],
                'email' => $data['username'] . "@" . $data['username'] . ".com",
                'password' => Hash::make($data['password']),
                'user_level' => 1,
            );
            return User::create($user);
            return redirect()->route('user.manage')->withSuccess('New User Created');
        }else{
            $user = array(
                'username' => $data['username'],
                'email' => $data['username'] . "@" . $data['username'] . ".com",
                'password' => Hash::make($data['password']),
                'user_level' => 99,
            );
            User::create($user);
            Auth::attempt($user);
            return redirect()->route('user.manage')->withSuccess('Welcome !');
        }
        
    }
}
