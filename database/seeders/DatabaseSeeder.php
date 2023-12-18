<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Resource;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $categories = Category::factory()->count(5)->create();
        Category::create(['name' => 'PHP']);
        Category::create(['name' => 'JavaScript']);
        Category::create(['name' => 'Vue.js']);
        Category::create(['name' => 'Python']);
        Category::create(['name' => 'Java']);
        Category::create(['name' => 'Flask']);
 
        foreach (Category::all() as $category){
            Resource::factory()->count(5)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
