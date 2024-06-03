<?php

namespace Database\Seeders;

use App\Models\SuperUser;
use App\Models\Tenant;
use App\Models\TenantMenuCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'user a',
            'email' => 'user_a@gmail.com',
            'phone_number' => '089620031234',
            'password' => Hash::make('user_a'),
        ]);
        SuperUser::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        Tenant::create([
            'tenant_name' => 'tenant a',
            'email' => 'tenant_a@gmail.com',
            'tenant_location' => 'Jl. Tanjung Duren',
            'password' => Hash::make('tenant_a'),
            'super_user_id' => 1,
        ]);
        TenantMenuCategory::create([
            'tenant_menu_category_name' => 'Fast Food'
        ]);
        TenantMenuCategory::create([
            'tenant_menu_category_name' => 'Vegetables'
        ]);
        TenantMenuCategory::create([
            'tenant_menu_category_name' => 'Meat'
        ]);
    }
}
