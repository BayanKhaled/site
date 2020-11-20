<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\members;
use App\DataTables\membersDatatables;
use App\DataTables\membersEditorDatatables;
use DB;

class membersController extends Controller
{

    public function goback()
    {
        // return $dataTable->render('index2');
        $products = DB::table("products")->get();
        return view('products',compact('products'));
    }

    public function gobackdestroy($id)
    {
        DB::table("products")->delete($id);
        return response()->json(['success'=>"Product Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

     public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("products")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }

    public function index(membersDatatables $dataTable)
    {
        return $dataTable->render('index2');
    }



    public function store(Request $request, membersEditorDatatables $editor)
    {
        
        return $editor->process(request());
    }





    public function create()
    {
        return view('welcome');
    }

    public function show(members $members)
    {
        //
    }


    public function edit(members $members)
    {
        //
    }


    public function update(Request $request, members $members)
    {
        //
    }

    public function destroy(members $members)
    {
        //
    }
}
