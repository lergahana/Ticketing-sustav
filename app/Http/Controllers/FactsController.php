<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FactsController extends Controller
{
    function data(){
        /*
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => 'random-facts2.p.rapidapi.com',
            'X-RapidAPI-Key' => '8e0c87bb97msh48a019a97726d28p17d056jsnc68b40e840fe',
        ])->get('https://random-facts2.p.rapidapi.com/getfact');

        $response =json_decode($response);
        $key_value = $response->Fact;

        return view("welcome", ["facts"=>$key_value]);*/
        return view("welcome", ["facts"=>"Random fact"]);
    }
}
