<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'Wesam Ashour',
            'email' => 'wesam@gmail.com',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'user']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
