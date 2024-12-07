<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ['name' => 'Telefonos Moviles', 'slug' => Str::slug('Telefonos Moviles'), 'category_id' => 1], // Electronica
            ['name' => 'Portatiles', 'slug' => Str::slug('Portatiles'), 'category_id' => 1],              // Electronica
            ['name' => 'Refrigeradores', 'slug' => Str::slug('Refrigeradores'), 'category_id' => 2],      // Electrodomesticos
            ['name' => 'Novelas', 'slug' => Str::slug('Novelas'), 'category_id' => 3],                   // Libros
            ['name' => 'Ficcion', 'slug' => Str::slug('Ficcion'), 'category_id' => 3],                   // Libros
            ['name' => 'Ropa de Hombre', 'slug' => Str::slug('Ropa de Hombre'), 'category_id' => 4],     // Ropa
            ['name' => 'Ropa de Mujer', 'slug' => Str::slug('Ropa de Mujer'), 'category_id' => 4],       // Ropa
            ['name' => 'Futbol', 'slug' => Str::slug('Futbol'), 'category_id' => 5],                     // Deportes
            ['name' => 'Tenis', 'slug' => Str::slug('Tenis'), 'category_id' => 5],                       // Deportes
        ];

        foreach ($subcategories as $subcategory) {
            SubCategory::create($subcategory);
        }
    }
}
