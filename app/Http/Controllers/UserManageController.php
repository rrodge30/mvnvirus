<?php

namespace App\Http\Controllers;
use Auth;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UserManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(){
        $this->middleware(['auth','isadmin'],['except'=>'register']);
    }
    
    public function index(){
        $users = DB::table('table_users')->where('user_level', '!=', 99)->get();
        return view('pages.manage-users.manage-users-main')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //VALIDATION
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')->withErrors($validator);
        }

        //CHECK IF PASSWORD MATCH

        if($request->password !== $request->password_confirmation){
            return redirect()->route('register')->withErrors("Password not match");
        }
        
        //CHECK FOR EXISTING USER (USERNAME)
        $user = DB::table('table_users')->where('username',$request->username)->first();


        if(Auth::guest()){
            $user_level = "99";
        }else{
            $user_level = "1";
        }

        if($user === null){
            $user = new User();
            $user->email = $request->username . "@" . $request->username . ".com";
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->user_level = $user_level;
            $user->save();
            if($user_level == "99"){
                Auth::login($user);
            }
            return redirect()->route('user.manage')->withSuccess("Successfully Created");
        }else{
            return redirect()->route('register')->withErrors("User Already Exist");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(DB::table('table_users')->where('id', $id)->delete()){
            return redirect()->route('user.manage')->withSuccess('User Has Been Deleted');
        }else{
            
            return redirect()->route('user.manage')->withError('Failed to Delete');
            
        }
        
    }
}
