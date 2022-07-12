<?php

namespace Database\Factories;

use App\Models\Schedule; //add
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => rand(1, 10),
            'screen_id' => rand(1, 3),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 hours'),
            'end_time' => $this->faker->dateTimeBetween('+1 hours', '+2 hours'),
        ];
    }
}
