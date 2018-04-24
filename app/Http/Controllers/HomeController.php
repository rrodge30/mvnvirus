<?php

namespace App\Http\Controllers;

use App\model\branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['branch'] = DB::table('table_branches')
                            ->orderBy('branch_name','ASC')
                            ->get();

        $data["id_branch"] = "";
        return view('home')->with('data',$data);
    }

    
    public function onChangeBranchValue($id){

        if($id === '-1'){
            $data['branch'] = DB::table('table_branches')
                            ->orderBy('branch_name','ASC')
                            ->get();

        }else{
           
            $data['branch'] = DB::table('table_branches')
                            ->orderBy('branch_name','ASC')
                            ->get();
            $data['items'] = DB::table('table_items')
                            ->where('branch_id',$id)   
                            ->orderBy('item_name','ASC')
                            ->get();
        }
        $data['id_branch'] = $id;
        return view('home')->with('data',$data);
    }

}
