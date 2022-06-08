<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TicketTechnician;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $otvoren = Status::where('status', 'otvoren')->pluck('id');

        return [
            'name' => 'Ticket ' . $this->faker->word,
            'description' => $this->faker->sentence,
            'id_status' => $otvoren[0],
            'id_client' => $this->faker->randomElement(Client::pluck('id')->toArray()),
            'id_user' => $this->faker->randomElement(User::where('role', 'agent')->pluck('id')->toArray()),
        ];
    }
}
