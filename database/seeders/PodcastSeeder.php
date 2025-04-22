<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Podcasts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        $categories->each(function ($category) {
            Podcasts::factory()->count(3)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
