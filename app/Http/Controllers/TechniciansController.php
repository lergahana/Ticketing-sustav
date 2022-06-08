<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Models\TicketTechnician;
use App\Models\Client;
use App\Models\User;
use App\Models\Status;
use App\Models\SolvedTicket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;

class TechniciansController extends Controller
{

    public function index_tickets()
    {
        $id_user = Auth::id();

        $tickets_id = DB::table('tickets_technicians')->where('id_technician', $id_user)->get()->pluck('id_ticket')->toArray();

        /*$all = Ticket::whereIn('id', $tickets_id)->where('id_status', 3)->sortable()->paginate(5)->fragment('tickets');*/
        $count = Ticket::whereIn('id', $tickets_id)->get();

        $solved = SolvedTicket::whereIn('id_ticket', $tickets_id)->get()->pluck('id_ticket')->toArray();

        $priority = Ticket::whereIn('id', $tickets_id)->where('id_status', 3)
        ->leftJoin('solved_tickets', 'tickets.id', '=', 'solved_tickets.id_ticket')
        ->orderBy('solved_tickets.solved', 'asc')->select('tickets.*')->sortable()->paginate(5)->fragment('tickets');

        return view('tech.lista_ticketa', [
            'tickets' => $priority,
            'num_tickets' => $count->count(),
            'solved' => $solved,
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

    public function solve($id)
    {
        $ticket = Ticket::where('id', $id)->get();

        $exists = SolvedTicket::where('id_ticket', $id)->get();

        if ($exists->count() <= 0){
            $solved = new SolvedTicket();
            $solved->id_ticket = $id;
            $solved->solved = 1;
            $solved->save();
        }
        
        return $this->index_tickets();

    }

}
