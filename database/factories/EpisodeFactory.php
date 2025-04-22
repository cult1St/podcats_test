<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Episode>
 */
class EpisodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   // database/factories/EpisodeFactory.php

    public function definition(): array
    {
        return [
            'podcast_id' => \App\Models\Podcasts::factory(),
            'title' => $this->faker->sentence(4),
            'audio_url' => $this->faker->url(),
            'duration' => $this->faker->time('i:s'),
        ];
    }

}
