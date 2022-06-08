<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Agent Default',
            'email' => 'agent.default@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('useruser'),
            'role' => 'agent',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Techinician Default',
            'email' => 'ticketing.sustav@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('useruser'),
            'role' => 'technician',
            'remember_token' => Str::random(10),
        ]);
        User::factory()
        ->count(18)
        ->create();
    }
}
