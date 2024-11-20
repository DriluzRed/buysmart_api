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
            ['name' => 'Electronicas', 'slug' => Str::slug('electronica')],
            ['name' => 'Ropa', 'slug' => Str::slug('ropa')],
            ['name' => 'Zapatos', 'slug' => Str::slug('zapatos')],
            ['name' => 'Computadoras', 'slug' => Str::slug('computadoras')],
            ['name' => 'Accesorios', 'slug' => Str::slug('accesorios')],
            ['name' => 'Hogar', 'slug' => Str::slug('hogar')],
            ['name' => 'Juguetes', 'slug' => Str::slug('juguetes')],
            ['name' => 'Deportes', 'slug' => Str::slug('deportes')],
            ['name' => 'Salud', 'slug' => Str::slug('salud')],
            ['name' => 'Belleza', 'slug' => Str::slug('belleza')],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
