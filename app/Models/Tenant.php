<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tenants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_name',
        'tenant_picture',
        'email',
        'tenant_location',
        'password',
        'super_user_id',
    ];

    public function tenantMenus(): HasMany
    {
        return $this->hasMany(TenantMenu::class);
    }

    public function superUser(): BelongsTo
    {
        return $this->belongsTo(SuperUser::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
