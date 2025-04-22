<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
  
    // database/seeders/DatabaseSeeder.php
public function run(): void
{
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
    \App\Models\Category::factory()->count(5)->create()->each(function ($category) {
        $podcasts = \App\Models\Podcasts::factory()->count(3)->create([
            'category_id' => $category->id
        ]);

        $podcasts->each(function ($podcast) {
            \App\Models\Episode::factory()->count(5)->create([
                'podcast_id' => $podcast->id
            ]);
        });
    });
}

}
