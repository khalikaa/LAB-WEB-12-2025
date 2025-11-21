<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductWarehouseSeeder extends Seeder
{
    public function run()
    {
        DB::table('products_warehouses')->insert([
            ['product_id' => 1, 'warehouse_id' => 1, 'quantity' => 10],
            ['product_id' => 1, 'warehouse_id' => 2, 'quantity' => 5],

            ['product_id' => 2, 'warehouse_id' => 1, 'quantity' => 20],
            ['product_id' => 2, 'warehouse_id' => 3, 'quantity' => 15],

            ['product_id' => 3, 'warehouse_id' => 2, 'quantity' => 50],

            ['product_id' => 4, 'warehouse_id' => 1, 'quantity' => 7],

            ['product_id' => 5, 'warehouse_id' => 3, 'quantity' => 12],
        ]);
    }
}
