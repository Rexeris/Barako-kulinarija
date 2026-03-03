<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Recipe;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $cat = Category::firstOrCreate(
            ['slug' => 'greita-ir-pigu'],
            ['name' => 'Greita ir pigu']
        );

        $title = 'Makaronai su tunu';
        Recipe::firstOrCreate(
            ['slug' => Str::slug($title)],
            [
                'category_id' => $cat->id,
                'title' => $title,
                'description' => 'Greitas studento klasikinis patiekalas.',
                'instructions' => "1) Išvirk makaronus.\n2) Įmaišyk tuną.\n3) Pagardink druska/pipirais.",
                'prep_time' => 5,
                'cook_time' => 10,
                'servings' => 2,
                'difficulty' => 'easy',
                'price_level' => '€',
            ]
        );
    }
}