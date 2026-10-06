<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryMovement extends Model
{
    protected $fillable = ['product_id', 'supplier_id', 'user_id', 'type', 'quantity', 'unit_cost', 'reference', 'notes', 'moved_at'];

    protected function casts(): array { return ['quantity' => 'decimal:3', 'unit_cost' => 'decimal:2', 'moved_at' => 'datetime']; }

    public function product(): BelongsTo { return $this->belongsTo(Product::class); }
    public function supplier(): BelongsTo { return $this->belongsTo(Supplier::class); }
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
}
