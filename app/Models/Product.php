<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'price', 'is_new', 'is_sale'
    ];

    /**
     * Связь многие ко многим с моделью Category.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Область фильтрации по цене.
     */
    public function scopePriceRange($query, $min, $max)
    {
        if ($min && $max) {
            return $query->whereBetween('price', [$min, $max]);
        }
        return $query;
    }

    /**
     * Область для фильтрации по новинкам.
     */
    public function scopeIsNew($query, $isNew)
    {
        if ($isNew) {
            return $query->where('is_new', true);
        }
        return $query;
    }

    /**
     * Область для фильтрации по распродаже.
     */
    public function scopeIsSale($query, $isSale)
    {
        if ($isSale) {
            return $query->where('is_sale', true);
        }
        return $query;
    }

    /**
     * Область для сортировки по названию или цене.
     */
    public function scopeSortBy($query, $sortBy, $order)
    {
        if (in_array($sortBy, ['name', 'price']) && in_array($order, ['asc', 'desc'])) {
            return $query->orderBy($sortBy, $order);
        }
        return $query;
    }
}
