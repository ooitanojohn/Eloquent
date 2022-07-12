<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Y-m-d'),
            'schedule_id' => rand(1, 10),
            'sheet_id' => rand(1, 45),
            'email' => $this->faker->address,
            'name' => $this->faker->name
        ];
    }
}
