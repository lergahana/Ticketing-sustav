<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Models\Client;
use App\Models\Technician;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function otvoreni_index()
    {
        $id_user = Auth::id();
        
        $all = DB::table('tickets')->where(
            'id_user', $id_user)->where(
                'id_status', 1)->get();
        
        return view('agent/otvoreni_ticketi', [
            'tickets' => $all
        ]);
    }

            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zatvoreni_index()
    {
        $id_user = Auth::id();
        
        $all = DB::table('tickets')->where(
            'id_user', $id_user)->where(
                'id_status', 3)->get();
        
        return view('agent/zatvoreni_ticketi', [
            'tickets' => $all
        ]);
    }

                /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function zaduzeni_index()
    {
        $id_user = Auth::id();
        
        $all = DB::table('tickets')->where(
            'id_user', $id_user)->where(
                'id_status', 2)->get();
        
        return view('agent/zaduzeni_ticketi', [
            'tickets' => $all
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //session(['id' => $id]);
        $id_user = Auth::id();
        $ticket = Ticket::where('id', $id)->get();
        $status = Status::where('id', $ticket[0]->id_status)->get();
        $client = Client::where('id', $ticket[0]->id_client)->get();
        $technician = Technician::where('id', $ticket[0]->id_technician)->get();


        return view('agent/prikazi_ticket', [
            'ticket' => $ticket[0],
            'status' => $status[0],
            'client' => $client[0],
            'technician' => $technician[0],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_user = Auth::id();
        $ticket = Ticket::where('id', $id)->get();
        $status = Status::where('id', $ticket[0]->id_status)->get();
        $client = Client::where('id', $ticket[0]->id_client)->get();
        $technician = Technician::where('id', $ticket[0]->id_technician)->get();

        return view('agent.uredi_ticket', [
            'ticket' => $ticket[0],
            'status' => $status[0],
            'client' => $client[0],
            'technician' => $technician[0],
        ]);
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
        $validated = $request->validate([
            'name' => 'required',
            'opis' => 'required',
            'status' => 'required',
        ]);

        $ticket = Ticket::find($id);
        $client = Client::find($ticket->id_client);

        $ticket->name = $request->name;

        $id_user = Auth::id();
        $ticket->id_user = $id_user;

        $ticket->description = $request->opis;

        if ($request->itemName){
            $technician = Technician::where('id', $request->itemName)->get()->pluck('id')->toArray();
            $ticket->id_technician = $technician[0];
        }

        if ($request->klijent){
            $client->name = $request->klijent;
            $client->save();
            $ticket->id_client = $client->id;
        }

        $status = Status::where('status', $request->status)->get()->pluck('id')->toArray();
        $ticket->id_status = $status[0];

        $ticket->save();
        if ($request->status == "otvoren") return redirect('/otvoreni_ticketi');
        if ($request->status == "zadužen") return redirect('/zaduzeni_ticketi');
        if ($request->status == "zatvoren") return redirect('/zatvoreni_ticketi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $status = Status::find($ticket->id_status);

        $ticket->delete();

        if ($status->status == "otvoren") return redirect('/otvoreni_ticketi');
        if ($status->status == "zadužen") return redirect('/zaduzeni_ticketi');
        if ($status->status == "zatvoren") return redirect('/zatvoreni_ticketi');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
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
