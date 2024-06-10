<?php

namespace Database\Seeders;

use App\Models\SuperUser;
use App\Models\Tenant;
use App\Models\TenantMenu;
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
            'name' => 'aaaa',
            'email' => 'aaaa@gmail.com',
            'phone_number' => '089620031234',
            'password' => Hash::make('aaaa'),
        ]);
        SuperUser::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        Tenant::create([
            'tenant_name' => 'kedai teriyaki',
            'tenant_picture' => 'tenant.jpg',
            'email' => 'kedaiteriyaki@gmail.com',
            'tenant_location' => 'Jl. Tanjung Duren',
            'password' => Hash::make('kedaiteriyaki'),
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
        TenantMenu::create([
            'tenant_id' => 1,
            'tenant_menu_category_id' => 1,
            'tenant_menu_name' => 'chicken teriyaki',
            'tenant_menu_picture' => '1717518067.jpg',
            'tenant_menu_description' => 'best chicken teriyaki ever!',
            'tenant_menu_price' => '60000',
            'tenant_menu_status' => '1',
        ]);
    }
}
