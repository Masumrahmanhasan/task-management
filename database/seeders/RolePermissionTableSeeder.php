<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_permissions = Permission::query()
            ->whereNotIn('slug', ['task-delete', 'user-read'])
            ->get();

        $user_role = Role::query()->where('slug', 'user')->first();
        $user_role->permissions()->attach($user_permissions);

        $admin_permissions = Permission::query()->get();
        $admin_role = Role::query()->where('slug', 'admin')->first();
        $admin_role->permissions()->attach($admin_permissions);
    }
}
