<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        Warehouse::insert([
            ['name' => 'Gudang Utama', 'location' => 'Jakarta'],
            ['name' => 'Gudang Timur', 'location' => 'Surabaya'],
            ['name' => 'Gudang Barat', 'location' => 'Bandung'],
        ]);
    }
}
