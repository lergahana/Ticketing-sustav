<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SearchClientsController extends Controller
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
            $data = DB::table("clients")
            		->select("id","name")
            		->where('name','LIKE',"%$search%")
            		->get();
        }
        return response()->json($data);
    }
}
