<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fishes = [
            // COMMON FISHES
            [
                'name' => 'Sardine',
                'rarity' => 'Common',
                'base_weight_min' => 0.10,
                'base_weight_max' => 0.25,
                'sell_price_per_kg' => 50,
                'catch_probability' => 45.00,
                'description' => 'A small, silvery fish found in large schools. Very common in shallow waters.'
            ],
            [
                'name' => 'Mackerel',
                'rarity' => 'Common',
                'base_weight_min' => 0.30,
                'base_weight_max' => 0.80,
                'sell_price_per_kg' => 75,
                'catch_probability' => 40.00,
                'description' => 'A fast-swimming fish with distinctive wavy patterns. Popular among beginner fishers.'
            ],
            [
                'name' => 'Anchovy',
                'rarity' => 'Common',
                'base_weight_min' => 0.05,
                'base_weight_max' => 0.15,
                'sell_price_per_kg' => 45,
                'catch_probability' => 50.00,
                'description' => 'Tiny but abundant fish. Often used as bait for larger catches.'
            ],

            // UNCOMMON FISHES
            [
                'name' => 'Cod',
                'rarity' => 'Uncommon',
                'base_weight_min' => 2.00,
                'base_weight_max' => 5.00,
                'sell_price_per_kg' => 150,
                'catch_probability' => 25.00,
                'description' => 'A popular white fish found in deeper, cooler waters. Highly valued for its meat.'
            ],
            [
                'name' => 'Sea Bass',
                'rarity' => 'Uncommon',
                'base_weight_min' => 1.50,
                'base_weight_max' => 4.00,
                'sell_price_per_kg' => 180,
                'catch_probability' => 22.00,
                'description' => 'A prized catch among coastal fishers. Known for its delicate flavor.'
            ],
            [
                'name' => 'Trout',
                'rarity' => 'Uncommon',
                'base_weight_min' => 0.80,
                'base_weight_max' => 2.50,
                'sell_price_per_kg' => 140,
                'catch_probability' => 28.00,
                'description' => 'Freshwater fish with beautiful spotted patterns. Loves cold, clean streams.'
            ],

            // RARE FISHES
            [
                'name' => 'Salmon',
                'rarity' => 'Rare',
                'base_weight_min' => 3.00,
                'base_weight_max' => 8.00,
                'sell_price_per_kg' => 300,
                'catch_probability' => 12.00,
                'description' => 'Famous for its upstream migration. Rich in nutrients and flavor.'
            ],
            [
                'name' => 'Red Snapper',
                'rarity' => 'Rare',
                'base_weight_min' => 2.50,
                'base_weight_max' => 6.00,
                'sell_price_per_kg' => 350,
                'catch_probability' => 10.00,
                'description' => 'Distinctive red-colored fish with excellent meat quality. A trophy catch!'
            ],
            [
                'name' => 'Grouper',
                'rarity' => 'Rare',
                'base_weight_min' => 5.00,
                'base_weight_max' => 12.00,
                'sell_price_per_kg' => 320,
                'catch_probability' => 11.50,
                'description' => 'Large, powerful fish that inhabits rocky reefs. Puts up a good fight!'
            ],

            // EPIC FISHES
            [
                'name' => 'Tuna',
                'rarity' => 'Epic',
                'base_weight_min' => 10.00,
                'base_weight_max' => 30.00,
                'sell_price_per_kg' => 600,
                'catch_probability' => 5.50,
                'description' => 'Massive, fast-swimming predator. One of the most sought-after game fish.'
            ],
            [
                'name' => 'Swordfish',
                'rarity' => 'Epic',
                'base_weight_min' => 15.00,
                'base_weight_max' => 40.00,
                'sell_price_per_kg' => 750,
                'catch_probability' => 4.00,
                'description' => 'Named for its long, sword-like bill. An incredible deep-sea warrior!'
            ],
            [
                'name' => 'Marlin',
                'rarity' => 'Epic',
                'base_weight_min' => 20.00,
                'base_weight_max' => 50.00,
                'sell_price_per_kg' => 800,
                'catch_probability' => 3.50,
                'description' => 'The ultimate trophy fish. Known for spectacular acrobatic jumps when hooked.'
            ],

            // LEGENDARY FISHES
            [
                'name' => 'Great White Shark',
                'rarity' => 'Legendary',
                'base_weight_min' => 100.00,
                'base_weight_max' => 250.00,
                'sell_price_per_kg' => 1500,
                'catch_probability' => 1.50,
                'description' => 'Apex predator of the ocean. Requires extreme skill and courage to catch.'
            ],
            [
                'name' => 'Giant Squid',
                'rarity' => 'Legendary',
                'base_weight_min' => 80.00,
                'base_weight_max' => 200.00,
                'sell_price_per_kg' => 1800,
                'catch_probability' => 1.00,
                'description' => 'Mysterious deep-sea creature. Rarely seen by humans, even rarer to catch.'
            ],
            [
                'name' => 'Megalodon',
                'rarity' => 'Legendary',
                'base_weight_min' => 300.00,
                'base_weight_max' => 500.00,
                'sell_price_per_kg' => 2500,
                'catch_probability' => 0.80,
                'description' => 'Ancient giant shark thought to be extinct. A living fossil of the deep!'
            ],

            // MYTHIC FISHES
            [
                'name' => 'Leviathan',
                'rarity' => 'Mythic',
                'base_weight_min' => 500.00,
                'base_weight_max' => 1000.00,
                'sell_price_per_kg' => 5000,
                'catch_probability' => 0.30,
                'description' => 'Legendary sea serpent from ancient tales. Said to control the tides themselves.'
            ],
            [
                'name' => 'Kraken',
                'rarity' => 'Mythic',
                'base_weight_min' => 600.00,
                'base_weight_max' => 1200.00,
                'sell_price_per_kg' => 6000,
                'catch_probability' => 0.20,
                'description' => 'Colossal octopus of legend. Capable of dragging entire ships to the depths.'
            ],
            [
                'name' => 'Phoenix Fish',
                'rarity' => 'Mythic',
                'base_weight_min' => 50.00,
                'base_weight_max' => 150.00,
                'sell_price_per_kg' => 8000,
                'catch_probability' => 0.25,
                'description' => 'Glowing fish that rises from volcanic vents. Its scales shimmer like flames.'
            ],

            // SECRET FISHES
            [
                'name' => 'Golden Koi',
                'rarity' => 'Secret',
                'base_weight_min' => 5.00,
                'base_weight_max' => 15.00,
                'sell_price_per_kg' => 10000,
                'catch_probability' => 0.10,
                'description' => 'Mystical golden fish that brings fortune. Only appears during full moons.'
            ],
            [
                'name' => 'Dragon Fish',
                'rarity' => 'Secret',
                'base_weight_min' => 200.00,
                'base_weight_max' => 400.00,
                'sell_price_per_kg' => 15000,
                'catch_probability' => 0.05,
                'description' => 'Ancient guardian of the deep. Said to grant wishes to those who catch and release it.'
            ],
            [
                'name' => 'Cosmic Whale',
                'rarity' => 'Secret',
                'base_weight_min' => 1000.00,
                'base_weight_max' => 2000.00,
                'sell_price_per_kg' => 20000,
                'catch_probability' => 0.01,
                'description' => 'The rarest of all catches. A celestial being that swims between dimensions. Legends say catching it unlocks the secrets of the universe.'
            ],
        ];

        foreach ($fishes as $fish) {
            DB::table('fishes')->insert([
                'name' => $fish['name'],
                'rarity' => $fish['rarity'],
                'base_weight_min' => $fish['base_weight_min'],
                'base_weight_max' => $fish['base_weight_max'],
                'sell_price_per_kg' => $fish['sell_price_per_kg'],
                'catch_probability' => $fish['catch_probability'],
                'description' => $fish['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}