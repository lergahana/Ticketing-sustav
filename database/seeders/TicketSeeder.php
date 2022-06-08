<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\TicketTechnician;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Kreira 100 otvorenih ticket-a povezanih s klijentima i agentima
        Ticket::factory()
        ->count(100)
        ->create();
    }
}
