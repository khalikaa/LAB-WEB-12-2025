<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['name' => 'Elektronik', 'description' => 'Peralatan elektronik'],
            ['name' => 'Fashion', 'description' => 'Pakaian & aksesoris'],
            ['name' => 'Makanan', 'description' => 'Produk makanan'],
            ['name' => 'Furniture', 'description' => 'Perabot rumah'],
            ['name' => 'Olahraga', 'description' => 'Peralatan olahraga'],
        ]);
    }
}
