<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->save();

        return redirect('/tickets/store');
    }
}
