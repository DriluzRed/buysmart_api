<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'slug' => Str::slug('Electronics')],
            ['name' => 'Home Appliances', 'slug' => Str::slug('Home Appliances')],
            ['name' => 'Books', 'slug' => Str::slug('Books')],
            ['name' => 'Clothing', 'slug' => Str::slug('Clothing')],
            ['name' => 'Sports', 'slug' => Str::slug('Sports')],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
