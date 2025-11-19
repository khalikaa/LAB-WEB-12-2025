<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,   // Parent 1
            WarehouseSeeder::class,  // Parent 2
            ProductSeeder::class,    // Child (terakhir)
        ]);
    }
}