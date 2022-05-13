<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SearchTechniciansController extends Controller
{
    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function dataAjax(Request $request)
    {
    	$data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("technicians")
            		->select("id","name")
            		->where('name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }
}