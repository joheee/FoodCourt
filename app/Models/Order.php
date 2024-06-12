<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id',
        'payment_picture',
        'user_id',
        'cart_id',
        'order_status',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tenants(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function transactions(): HasOne
    {
        return $this->HasOne(Transaction::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
