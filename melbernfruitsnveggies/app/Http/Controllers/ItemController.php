<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        
        $checkExistingItem = DB::table('table_Items')
                            ->where('item_name',trim($request->item_name))
                            ->where('branch_id',$request->id_branch)
                            ->where('item_unit',trim(strtolower($request->item_unit)))
                            ->count();
        if($checkExistingItem > 0){
            return redirect()->route('list.branch.change',array('id'=>$request->id_branch))->withError('Item Name Already Exist');
        }

        $dataList = array(
            'item_name'=>trim($request->item_name),
            'branch_id'=>$request->id_branch,
            'item_unit'=>trim(strtolower($request->item_unit)),
        );
        if(DB::table('table_Items')->insert($dataList)){
            return redirect()->route('list.branch.change',array('id'=>$request->id_branch))->withSuccess('New Item Created',array('id_branch'=>$request->id_branch));
        }else{
            return redirect()->route('home')->withError('Failed to Create Item');
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
    public function destroy(Request $request)
    {
        //
        if(DB::table('table_items')->where('id_item',$request->id_item)->delete()){
            
            return redirect()->route('list.branch.change',array('id'=>$request->id_branch))->withSuccess('Item Deleted');
           
        }else{
            return redirect()->route('list.branch.change',array('id'=>$request->id_branch))->withError('Failed to Delete Item');
        }
    }
}
