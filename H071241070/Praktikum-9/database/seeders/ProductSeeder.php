<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB; // Wajib import DB

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catElektronik = Category::where('name', 'Elektronik')->first();
        $gudangMakassar = Warehouse::where('name', 'Gudang Utama Makassar')->first();
        $gudangGowa = Warehouse::where('name', 'Gudang Cabang Gowa')->first();

        if (!$catElektronik || !$gudangMakassar || !$gudangGowa) {
            $this->command->error('Pastikan CategorySeeder dan WarehouseSeeder sudah ada dan dijalankan.');
            return;
        }

        DB::transaction(function () use ($catElektronik, $gudangMakassar) {
            // Buat Produk
            $laptop = Product::create([
                'name' => 'Laptop ASUS ROG',
                'price' => 17500000,
                'category_id' => $catElektronik->id
            ]);

            $laptop->detail()->create([
                'description' => 'Laptop gaming dengan spek tinggi.',
                'weight' => 2.5,
                'size' => '15.6 inch'
            ]);

            $laptop->warehouses()->attach([
                $gudangMakassar->id => ['quantity' => 10] 
            ]);
        });

        DB::transaction(function () use ($catElektronik, $gudangMakassar, $gudangGowa) {
            $keyboard = Product::create([
                'name' => 'Keyboard Mekanikal',
                'price' => 850000,
                'category_id' => $catElektronik->id
            ]);

            $keyboard->detail()->create([
                'description' => 'Keyboard mechanical blue switch.',
                'weight' => 0.8,
                'size' => 'TKL'
            ]);

            $keyboard->warehouses()->attach([
                $gudangMakassar->id => ['quantity' => 50], 
                $gudangGowa->id => ['quantity' => 20]      
            ]);
        });
    }
}