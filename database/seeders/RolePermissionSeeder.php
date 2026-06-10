<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $productPermissions = [
            'view products',
            'create products',
            'edit products',
            'delete products'
        ];
        $orderPermissions = [
            'view orders',
            'update order status',
            'delete orders'
        ];
        $categoryPermissions = [
            'view categories',
            'create categories',
            'edit categories',
            'delete categories'
        ];
        $userPermissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles'
        ];
        $allPermissions = array_merge(
            $productPermissions,
            $orderPermissions,
            $categoryPermissions,
            $userPermissions
        );
        foreach($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
        
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo($allPermissions);

        $staffRole = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        $staffRole->givePermissionTo([
            'view products',
            'create products',
            'edit products',
            'view orders',
            'update order status',
            'view users'
        ]);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        $adminUser = User::where('email', 'admin@gmail.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        } 

        $users = User::where('is_admin', false)->get();
        foreach ($users as $user) {
            if (!$user->hasRole('admin')) {
                $user->assignRole('customer');
            }
        }
        $this->command->info('Roles and Permissions seeded successfully');
    }
}
