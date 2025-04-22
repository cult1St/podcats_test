<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Podcasts>
 */
class PodcastsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   // database/factories/PodcastFactory.php

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'category_id' => \App\Models\Category::factory(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'podcast', true),
            'featured' => $this->faker->boolean(20), // ~20% will be featured
        ];
    }

}
