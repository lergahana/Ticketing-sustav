<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Models\TicketTechnician;
use App\Models\Client;
use App\Models\Status;
use App\Models\User;
use App\Models\SolvedTicket;

use Notification;
use Exception;
use App\Notifications\EmailNotification;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination;

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
        
        $all = Ticket::where('id_user', $id_user)->where('id_status', 1)->sortable()->paginate(5)->fragment('tickets');

        $id_tickets = DB::table('tickets')->where('id_user', $id_user)->where('id_status', 1)->get()->pluck('id')->toArray();

        $solved = SolvedTicket::whereIn('id_ticket', $id_tickets)->get()->pluck('id_ticket')->toArray();

        return view('agent/otvoreni_ticketi', [
            'tickets' => $all,
            'num_tickets' => $all->count(),
            'solved' => $solved,
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
        
        $all = Ticket::where('id_user', $id_user)->where('id_status', 4)->sortable()->paginate(5)->fragment('tickets');
        
        $id_tickets = DB::table('tickets')->where('id_user', $id_user)->where('id_status', 4)->get()->pluck('id')->toArray();

        $solved = SolvedTicket::whereIn('id_ticket', $id_tickets)->get()->pluck('id_ticket')->toArray();
        
        return view('agent/zatvoreni_ticketi', [
            'tickets' => $all,
            'num_tickets' => $all->count(),
            'solved' => $solved,
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
        
        $all = Ticket::where('id_user', $id_user)->where('id_status', 3)->sortable()->paginate(5)->fragment('tickets');

        $id_tickets = DB::table('tickets')->where('id_user', $id_user)->where('id_status', 3)->get()->pluck('id')->toArray();

        $solved = SolvedTicket::whereIn('id_ticket', $id_tickets)->get()->pluck('id_ticket')->toArray();

        $priority = Ticket::where('id_user', $id_user)->where('id_status', 3)
        ->leftJoin('solved_tickets', 'tickets.id', '=', 'solved_tickets.id_ticket')
        ->orderBy('solved_tickets.solved', 'desc')->select('tickets.*')->sortable()->paginate(5)->fragment('tickets');

        return view('agent/zaduzeni_ticketi', [
            'tickets' => $all,
            'sort' => $priority,
            'num_tickets' => $all->count(),
            'solved' => $solved,
        ]);
    }

    public function forma_novi(){
        $all_tech = User::where('role', 'technician')->get();
        $all_clients = DB::table('clients')->get();

        return view('agent.novi_ticket', [
            'technicians' => $all_tech,
            'clients' => $all_clients
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
        $tech_id = TicketTechnician::where('id_ticket', $id)->get()->pluck('id_technician')->toArray();
        $techs = array();
        $i = 0;
        foreach($tech_id as $t){
            $techs[$i] = User::select('id', 'name')->where('id', $t)->get();
            $i += 1;
        }

        return view('agent/prikazi_ticket', [
            'ticket' => $ticket[0],
            'status' => $status[0],
            'client' => $client[0],
            'technicians' => $techs,
            'num_techs' => $i,
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
        $all_clients = Client::all();
        $tech_id = TicketTechnician::where('id_ticket', $id)->get()->pluck('id_technician')->toArray();
        $techs = array();
        $i = 0;
        foreach($tech_id as $t){
            $techs[$i] = User::select('id', 'name')->where('id', $t)->get();
            $i += 1;
        }
        $all_techs = User::where('role', 'technician')->get();

        return view('agent/uredi_ticket', [
            'ticket' => $ticket[0],
            'status' => $status[0],
            'client' => $client[0],
            'all_clients' => $all_clients,
            'technicians' => $techs,
            'num_techs' => $i,
            'all_techs' => $all_techs,
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

        $agent = User::where('id', $ticket->id_user)->get();

        $ticket->name = $request->name;

        $id_user = Auth::id();
        $ticket->id_user = $id_user;

        $ticket->description = $request->opis;
        if($request->tech){
            $old_relation = TicketTechnician::where('id_ticket', $id)->delete();
            foreach ($request->tech as $tech){
                $technician = User::where('id', $tech)->get()->pluck('id')->toArray();
                $relation = new TicketTechnician();
                $relation->id_ticket = $ticket->id;
                $relation->id_technician = $technician[0];
                $relation->save();
                $sending = $this->send($tech, $agent, $request->status);
            }
        }

        if ($request->klijent){
            $ticket->id_client = $request->klijent;
        }

        $status = Status::where('status', $request->status)->get()->pluck('id')->toArray();
        if($request->tech == null && $request->status != 'zatvoren'){
            $old_relation = TicketTechnician::where('id_ticket', $id)->delete();
            $status = Status::where('status', 'otvoren')->get()->pluck('id')->toArray();
        }
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
        ]);

        $ticket = new Ticket();
        $ticket->name = $request->name;

        $id_user = Auth::id();
        $ticket->id_user = $id_user;

        $agent = User::where('id', $id_user)->get();

        $ticket->description = $request->opis;

        $ticket->id_client = $request->klijent;

        if($request->tech == null){
            $request->status = 'otvoren';
        }
        $status = Status::where('status', $request->status)->get()->pluck('id')->toArray();
        $ticket->id_status = $status[0];

        $ticket->save();

        if($request->tech){        
            foreach ($request->tech as $tech){
                $technician = User::where('id', $tech)->get()->pluck('id')->toArray();
                $relation = new TicketTechnician();
                $relation->id_ticket = $ticket->id;
                $relation->id_technician = $technician[0];
                $relation->save();
                $sending = $this->send($tech, $agent, $request->status);
            }
        }

        if ($request->status == "otvoren") return redirect('/otvoreni_ticketi');
        if ($request->status == "zadužen") return redirect('/zaduzeni_ticketi');
    }

    public function send($tech, $agent, $status) 
    {
    	$user = User::where('id', $tech)->get();

        $project = [
            'greeting' => 'Hi '.$user[0]->name.',',
            'body' => 'There is a new ticket assigned to you by '.$agent[0]->name.'.',
            'thanks' => 'Thank you!',
            'actionText' => 'View Project',
            'actionURL' => url('/'),
            'id' => 57
        ];
  
        try{
            Notification::send($user, new EmailNotification($project));
            return "Notification";
        } catch (Exception $e){
            return "No notification";
        }
        
    }
}
