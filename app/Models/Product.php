<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'sku', 'unit', 'current_stock', 'minimum_stock', 'purchase_price', 'sale_price', 'active'];

    protected function casts(): array { return ['current_stock' => 'decimal:3', 'minimum_stock' => 'decimal:3', 'purchase_price' => 'decimal:2', 'sale_price' => 'decimal:2', 'active' => 'boolean']; }

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function movements(): HasMany { return $this->hasMany(InventoryMovement::class); }
    public function getIsLowStockAttribute(): bool { return $this->current_stock <= $this->minimum_stock; }
}
