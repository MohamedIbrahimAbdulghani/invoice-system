<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'roles_name' => ['owner'],
            'status' => 'مفعل',
        ]);

        $roles = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $roles->syncPermissions($permissions);
        $user->assignRole([$roles->id]);
    }
}