<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Action',
            'description' => 'Action-packed comics with thrilling adventures.',
        ]);

        Category::create([
            'name' => 'Adventure',
            'description' => 'Comics that take you on exciting journeys.',
        ]);

        Category::create([
            'name' => 'Fantasy',
            'description' => 'Comics set in magical worlds with mythical creatures.',
        ]);

        Category::create([
            'name' => 'Horror',
            'description' => 'Comics that send chills down your spine.',
        ]);

        Category::create([
            'name' => 'Science Fiction',
            'description' => 'Comics exploring futuristic concepts and technology.',
        ]);
    }
}
