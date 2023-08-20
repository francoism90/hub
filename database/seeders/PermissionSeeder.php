<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Create permissions
        Permission::firstOrCreate(['name' => 'edit tags']);
        Permission::firstOrCreate(['name' => 'delete tags']);
        Permission::firstOrCreate(['name' => 'publish tags']);
        Permission::firstOrCreate(['name' => 'unpublish tags']);

        Permission::firstOrCreate(['name' => 'edit videos']);
        Permission::firstOrCreate(['name' => 'delete videos']);
        Permission::firstOrCreate(['name' => 'publish videos']);
        Permission::firstOrCreate(['name' => 'unpublish videos']);

        // Create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'moderator'])
            ->syncPermissions(['publish videos', 'unpublish videos']);

        $role = Role::firstOrCreate(['name' => 'super-admin']);
        $role->syncPermissions(Permission::all());
    }
}
