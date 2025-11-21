<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            ['name' => 'Laptop Lenovo', 'price' => 8500000, 'category_id' => 1],
            ['name' => 'Kemeja Pria', 'price' => 250000, 'category_id' => 2],
            ['name' => 'Snack Kentang', 'price' => 12000, 'category_id' => 3],
            ['name' => 'Kursi Kayu', 'price' => 450000, 'category_id' => 4],
            ['name' => 'Sepatu Running', 'price' => 650000, 'category_id' => 5],
        ]);
    }
}
