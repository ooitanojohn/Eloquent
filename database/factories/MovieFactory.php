<?php

namespace Database\Factories;

use App\Models\Movie; //add
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 単語ランダムデータ作成
        return [
        'title' => $this->faker->word(),
        'published_year' => $this->faker->dateTimeBetween('now','+3 months'),
        'is_showing' =>  $this->faker->boolean(),
        'description' =>  $this->faker->sentence(),
        'image_url' =>  $this->faker->imageUrl(640, 480, 'animals', true)
        ];
    }
}
