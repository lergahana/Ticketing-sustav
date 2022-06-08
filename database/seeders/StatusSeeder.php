<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{

    /* Spremaju se statusi:
            1 = otvoren
            2 = čekanje
            3 = zadužen
            4 = zatvoren
    */
    public function run()
    {
        Status::create([
            'status' => 'otvoren',
        ]);
        Status::create([
            'status' => 'čekanje',
        ]);
        Status::create([
            'status' => 'zadužen',
        ]);
        Status::create([
            'status' => 'zatvoren',
        ]);
    }
}
