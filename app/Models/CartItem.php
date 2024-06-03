<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cart_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_menu_id',
        'quantity',
        'cart_id'
    ];

    public function tenantMenus(): BelongsTo
    {
        return $this->belongsTo(TenantMenu::class);
    }

    public function carts(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
