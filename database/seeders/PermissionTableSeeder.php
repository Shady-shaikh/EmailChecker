<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions =
            [
                [
                    'name' => 'role_create',
                    'module_name' => 'Roles',
                    'display_name' => 'Create Role',
                    'description' => 'Create a new role',
                ],
                [
                    'name' => 'role_read',
                    'module_name' => 'Roles',
                    'display_name' => 'Read Role',
                    'description' => 'View existing roles',
                ],
                [
                    'name' => 'role_update',
                    'module_name' => 'Roles',
                    'display_name' => 'Update Role',
                    'description' => 'Update an existing role',
                ],
                [
                    'name' => 'role_delete',
                    'module_name' => 'Roles',
                    'display_name' => 'Delete Role',
                    'description' => 'Delete an existing role',
                ],
                [
                    'name' => 'plan_create',
                    'module_name' => 'Plans',
                    'display_name' => 'Create Plan',
                    'description' => 'Create a new plan',
                ],
                [
                    'name' => 'plan_read',
                    'module_name' => 'Plans',
                    'display_name' => 'Read Plan',
                    'description' => 'View existing plan',
                ],
                [
                    'name' => 'plan_update',
                    'module_name' => 'Plans',
                    'display_name' => 'Update Plan',
                    'description' => 'Update an existing plan',
                ],
                [
                    'name' => 'plan_delete',
                    'module_name' => 'Plans',
                    'display_name' => 'Delete Plan',
                    'description' => 'Delete an existing plan',
                ],
                [
                    'name' => 'user_create',
                    'module_name' => 'Users',
                    'display_name' => 'Create User',
                    'description' => 'Create a new user',
                ],
                [
                    'name' => 'user_read',
                    'module_name' => 'Users',
                    'display_name' => 'Read User',
                    'description' => 'View existing user',
                ],
                [
                    'name' => 'user_update',
                    'module_name' => 'Users',
                    'display_name' => 'Update User',
                    'description' => 'Update an existing user',
                ],
                [
                    'name' => 'user_delete',
                    'module_name' => 'Users',
                    'display_name' => 'Delete User',
                    'description' => 'Delete an existing user',
                ]
            ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission['name']], $permission);
        }
    }
}
