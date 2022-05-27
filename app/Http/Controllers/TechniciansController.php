<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Models\TicketTechnician;
use App\Models\Client;
use App\Models\User;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

class TechniciansController extends Controller
{

    public function index_tickets()
    {
        $id_user = Auth::id();

        $tickets_id = DB::table('tickets_technicians')->where('id_technician', $id_user)->get()->pluck('id_ticket')->toArray();

        $tickets = Ticket::whereIn('id', $tickets_id)->get();

        return view('tech.lista_ticketa', [
            'tickets' => $tickets
        ]);
    }

    public function show_tickets($id)
    {
        $id_user = Auth::id();
        $ticket = Ticket::where('id', $id)->get();
        $status = Status::where('id', $ticket[0]->id_status)->get();
        $client = Client::where('id', $ticket[0]->id_client)->get();
        $tech_id = TicketTechnician::where('id_ticket', $id)->get()->pluck('id_technician')->toArray();
        $agent_id = Ticket::where('id', $id)->get()->pluck('id_user')->toArray();
        $agent = User::where('id', $agent_id)->get();
        $techs = array();
        $i = 0;
        foreach($tech_id as $t){
            $techs[$i] = User::select('id', 'name')->where('id', $t)->get();
            $i += 1;
        }
        
        return view('tech/prikazi_ticket', [
            'ticket' => $ticket[0],
            'status' => $status[0],
            'client' => $client[0],
            'technicians' => $techs,
            'agent' => $agent[0],
            'num_techs' => $i,
        ]);

    }

}
