<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'category_id',
    ];

    // (Relasi 1:N - Sisi Child)
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
        // (Relasi 1:1 - Sisi Parent)

    public function detail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    // (Relasi N:M)
    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class)->withPivot('quantity');
    }
}