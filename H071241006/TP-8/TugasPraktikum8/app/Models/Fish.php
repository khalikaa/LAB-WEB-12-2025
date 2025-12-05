<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Fish extends Model
{
    protected $table = 'fishes';

    protected $fillable = [
        'name',
        'rarity',
        'base_weight_min',
        'base_weight_max',
        'sell_price_per_kg',
        'catch_probability',
        'description'
    ];

    protected $casts = [
        'base_weight_min' => 'decimal:2',
        'base_weight_max' => 'decimal:2',
        'catch_probability' => 'decimal:2',
    ];

    public function getFormattedPriceAttribute()
    {
        return number_format($this->sell_price_per_kg, 0, ',', '.') . ' Coins/kg';
    }

    public function getFormattedWeightRangeAttribute()
    {
        return number_format($this->base_weight_min, 2) . ' kg - ' . number_format($this->base_weight_max, 2) . ' kg';
    }

    public function scopeRarity(Builder $query, $rarity)
    {
        if ($rarity && in_array($rarity, ['Common','Uncommon','Rare','Epic','Legendary','Mythic','Secret'])) {
            return $query->where('rarity', $rarity);
        }
        return $query;
    }
}
