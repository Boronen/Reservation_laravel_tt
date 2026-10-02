<?php

namespace Database\Factories;

use App\Models\Airline;
use App\Models\flight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'airline_id' => Airline::all()->random()->id,
            'limit'=>fake()->numberBetween(1,20)
        ];
    }
}
