<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\TicketTechnician;
use App\Models\Client;
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
        $status = [1, 2, 4];

        return [
            'name' => 'Ticket ' . $this->faker->unique()->numberBetween($min = 1, $max = 50),
            'description' => $this->faker->sentence,
            'id_status' => Arr::random($status),
            'id_client' => $this->faker->randomElement(Client::pluck('id', 'id')->toArray()),
            'id_user' => "2",
        ];
    }
}
