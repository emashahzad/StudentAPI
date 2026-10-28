<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $permissions = [
            'view students',
            'create students',
            'edit students',
            'delete students',

            'view courses',
            'create courses',
            'edit courses',
            'delete courses',

            'view enrollments',
            'create enrollments',
            'edit enrollments',
            'delete enrollments',

        ];
        foreach($permissions as $permission){
            Permission::findOrCreate($permission, 'web');
        }
        $admin = Role::findOrCreate('admin', 'web');
        $user = Role::findOrCreate('user','web');
        $admin->syncPermissions($permissions);
        $user->syncPermissions(['view students', 'view courses', 'view enrollments']);
    }
}
