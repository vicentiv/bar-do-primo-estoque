<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = ['name', 'contact_name', 'phone', 'email', 'city', 'notes', 'active'];

    protected function casts(): array { return ['active' => 'boolean']; }

    public function movements(): HasMany { return $this->hasMany(InventoryMovement::class); }
}
