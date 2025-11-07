<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use function PHPUnit\Framework\returnArgument;

class Fish extends Model
{
    //acc mod
    use HasFactory;
    protected $table = "fishes";
    protected $fillable = [
        "name",
        "rarity",
        "base_weight_min",
        "base_weight_max",
        "sell_price_per_kg",
        "catch_probability",
        "description",
    ];
    //tipe data bawaan
    protected $casts = [
        "base_weight_min" => "decimal:2",
        "base_weight_max" => "decimal:2",
        "sell_price_per_kg" => "integer",
        "catch_probability" => "decimal:2",
    ];
    //use accessor  
    public function getFormattedSellPriceAttribute(): string
    {
        return number_format ($this -> sell_price_per_kg, 0, ",","."). "coins";
    }

    public function getFormattedWeightRangeAttribute()
    {
        return $this->base_weight_min . 'kg -'. $this->base_weight_max . "kg";
    }
}
