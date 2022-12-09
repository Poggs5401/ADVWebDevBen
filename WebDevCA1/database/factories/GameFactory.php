<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'category' => $this->faker->text(50),
            'game_image' => $this->faker->image(storage_path('storage\app/public/images'), 150, 150),
            'description' => $this->faker->text(200),

        ];
    }
}
