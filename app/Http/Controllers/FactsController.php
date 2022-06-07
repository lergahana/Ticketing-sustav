<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FactsController extends Controller
{
    function data(){

        $response = Http::get('https://uselessfacts.jsph.pl/random.json?language=en');

        $response =json_decode($response);

        if (isset($response->text)){
            $key_value = $response->text;
        } else {
            $key_value = "The Spanish national anthem has no words.";
        }
        
        return view("welcome", ["facts"=>$key_value]);
        
    }
}
