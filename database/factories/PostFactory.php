<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->word(5),
            "short_description" => $this->faker->text(10),
            "description" => $this->faker->text(25),
            "cover" => 'https://via.placeholder.com/1000',
            "miniature" => 'https://via.placeholder.com/400',
        ];
    }
}
