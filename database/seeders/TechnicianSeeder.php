<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class TechnicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::newTechnician()
        ->count(20)
        ->create();
    }
}
