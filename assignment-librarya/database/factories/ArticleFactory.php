<?php

namespace Database\Factories;

use App\Enums\PublicationStatus;
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
            'publication_status_id' => PublicationStatus::DRAFT,
            'title' => fake()->sentence,
            'text' => fake()->text(500),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
