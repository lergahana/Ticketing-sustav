<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class ClientsController extends Controller
{

    public function forma_novi()
    {
        return view('agent.novi_klijent');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        Client::query()->create([
            'name' => $validated['name'],
        ]);

        return redirect('home');
    }
}
