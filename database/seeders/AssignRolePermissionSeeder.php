<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'super_admin')->first();
        if (!empty($role)) {
            $permission = Permission::get();
            if (!empty($permission)) {
                $role->givePermissions($permission);
            }
        }
    }
}
