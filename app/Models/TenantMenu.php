<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TenantMenu extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenant_menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'tenant_menu_category_id',
        'tenant_menu_name',
        'tenant_menu_description',
        'tenant_menu_price',
        'tenant_menu_picture',
        'tenant_menu_status'
    ];

    public function tenantMenuCategorys(): BelongsTo
    {
        return $this->belongsTo(TenantMenuCategory::class);
    }

    public function cartItems(): HasMany{
        return $this->hasMany(CartItem::class);
    }

    public function tenants(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
