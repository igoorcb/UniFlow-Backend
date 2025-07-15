<?php

namespace App\Infrastructure\Ecommerce\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasUuids, HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id',
        'sku',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function hasStock(int $quantity = 1): bool
    {
        return $this->stock >= $quantity;
    }

    public function decrementStock(int $quantity = 1): self
    {
        if ($this->stock < $quantity) {
            throw new \Exception("Quantidade insuficiente em estoque");
        }

        $this->stock -= $quantity;
        $this->save();

        return $this;
    }

    public function incrementStock(int $quantity = 1): self
    {
        $this->stock += $quantity;
        $this->save();

        return $this;
    }


    public function activate(): self
    {
        $this->is_active = true;
        $this->save();

        return $this;
    }

    public function deactivate(): self
    {
        $this->is_active = false;
        $this->save();

        return $this;
    }
}
