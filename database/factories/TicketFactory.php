<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Ticket ' . $this->faker->unique()->numberBetween($min = 1, $max = 50),
            'description' => $this->faker->paragraph,
            'id_status' => $this->faker->numberBetween($min = 0, $max = 3),
            'id_client' => $this->faker->randomElement(Client::pluck('id', 'id')->toArray()),
            'id_user' => $this->faker->randomElement(User::where('role', 'agent')->pluck('id', 'id')->toArray()),
            TicketTehnicianSeeder::class,
        ];
    }
}
