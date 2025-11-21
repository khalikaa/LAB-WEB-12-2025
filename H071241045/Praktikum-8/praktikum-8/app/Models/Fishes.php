<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fishes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rarity',
        'base_weight_min',
        'base_weight_max',
        'sell_price_per_kg',
        'catch_probability',
        'description',
    ];

    /**
     * === SCOPES ===
     */

    // Filter berdasarkan rarity
    public function scopeRarity($query, $rarity)
    {
        if (!empty($rarity)) {
            $query->where('rarity', $rarity);
        }
        return $query;
    }

    // Search berdasarkan nama ikan
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }
        return $query;
    }

    /**
     * === ACCESSORS ===
     */

    public function getFormattedPriceAttribute()
    {
        return number_format($this->sell_price_per_kg, 0, ',', '.') . ' Coins';
    }

    public function getFormattedWeightRangeAttribute()
    {
        return "{$this->base_weight_min} - {$this->base_weight_max} kg";
    }


    // Urutan rarity (Common → Uncommon → Rare → Epic → Legendary → Mythic → Secret)
    public static $rarityOrder = [
        'Common' => 1,
        'Uncommon' => 2,
        'Rare' => 3,
        'Epic' => 4,
        'Legendary' => 5,
        'Mythic' => 6,
        'Secret' => 7,
    ];

    // Scope default: semua query otomatis urut berdasarkan rarity
    protected static function booted()
    {
        static::addGlobalScope('rarity_order', function ($query) {
            $query->orderByRaw("
                CASE rarity
                    WHEN 'Common' THEN 1
                    WHEN 'Uncommon' THEN 2
                    WHEN 'Rare' THEN 3
                    WHEN 'Epic' THEN 4
                    WHEN 'Legendary' THEN 5
                    WHEN 'Mythic' THEN 6
                    WHEN 'Secret' THEN 7
                    ELSE 8
                END
            ");
        });
    }

    // Warna badge rarity
    public function getRarityColorAttribute()
    {
        return match ($this->rarity) {
            'Common' => 'bg-gray-500',
            'Uncommon' => 'bg-green-500',
            'Rare' => 'bg-blue-500',
            'Epic' => 'bg-purple-500',
            'Legendary' => 'bg-yellow-500',
            'Mythic' => 'bg-pink-500',
            'Secret' => 'bg-red-500',
            default => 'bg-gray-400',
        };
    }
}
