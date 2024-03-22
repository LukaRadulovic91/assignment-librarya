<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'publication_status_id' => fake()->numberBetween(1,4),
            'title' => fake()->sentence,
            'text' => fake()->text(500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
