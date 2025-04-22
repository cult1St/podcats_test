<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\Podcasts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $podcasts = Podcasts::all();

        $podcasts->each(function ($podcast) {
            Episode::factory()->count(5)->create([
                'podcast_id' => $podcast->id,
            ]);
        });
    }
}
