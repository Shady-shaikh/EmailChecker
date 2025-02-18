<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'Pass@123'
            ]
        ];

        foreach ($users as $user) {
            $create = User::updateOrCreate(['email' => $user['email']], $user);
            $role = Role::where('name', 'super_admin')->first();
            $create->addRole($role);
        }
    }
}
