<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductDetail;

class ProductDetailSeeder extends Seeder
{
    public function run()
    {
        ProductDetail::insert([
            ['product_id' => 1, 'description' => 'Laptop 14 inch', 'weight' => 1.4, 'size' => '14 inch'],
            ['product_id' => 2, 'description' => 'Kemeja lengan panjang', 'weight' => 0.3, 'size' => 'M'],
            ['product_id' => 3, 'description' => 'Snack asin gurih', 'weight' => 0.1, 'size' => '80gr'],
            ['product_id' => 4, 'description' => 'Kursi kayu jati', 'weight' => 5.5, 'size' => 'Standard'],
            ['product_id' => 5, 'description' => 'Sepatu olahraga', 'weight' => 0.9, 'size' => '42'],
        ]);
    }
}
