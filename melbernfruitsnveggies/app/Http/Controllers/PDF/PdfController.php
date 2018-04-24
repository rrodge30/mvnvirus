<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PDF;
use App\User;

class PdfController extends Controller
{
    public function pdfExportList(Request $request){
        
        DB::table('table_transaction')->insert(['branch_id'=>$request->id_branch]); //ID BRANCH FROM DELETE ITEM FORM
        $id_trans = DB::getPdo()->lastInsertId();
        $dataList["id_trans"] = $id_trans;
        $dataList["branch"] = $branchData = DB::table('table_branches')->where('id_branch',$request->id_branch)->first();
        
        $selectedItems = array();
        
        foreach($request->id_items as $key=>$value){

            $selectedItems[$key] = array(
                'id_item' => $request->id_items[$key],
                'item_name' => $request->item_name[$key],
                'item_unit' => $request->item_unit[$key],
                'item_quantity' => $request->item_quantity[$key],
                'item_price' => $request->item_price[$key],
            );
            
        }
        
        $dataList["items"] = $selectedItems;
        
        $pdf = PDF::loadView('pdf/pdf',array('data'=>$dataList));
        return $pdf->setPaper('a6')->stream('Sales_Order.pdf');
    }
}
