<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Models\Client;
use App\Models\Technician;
use App\Models\Status;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'opis' => 'required',
            'status' => 'required',
            'klijent' => 'required',
            'itemName' => 'required',
        ]);

        $ticket = new Ticket();
        $ticket->name = $request->name;

        $id_user = Auth::id();
        $ticket->id_user = $id_user;

        $ticket->description = $request->opis;

        $technician = Technician::where('id', $request->itemName)->get()->pluck('id')->toArray();
        $ticket->id_technician = $technician[0];

        $client = new Client();
        $client->name = $request->klijent;
        $client->save();

        $ticket->id_client = $client->id;
        
        $status = Status::where('status', $request->status)->get()->pluck('id')->toArray();
        $ticket->id_status = $status[0];

        $ticket->save();
        
        return redirect('/otvoreni_ticketi');
    }
}
