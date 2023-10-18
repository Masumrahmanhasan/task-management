<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_role = Role::query()->where('slug', 'user')->first();
        $admin_role = Role::query()->where('slug', 'admin')->first();

        User::factory()->admin(1)->create()->each(function (User $user) use ($admin_role){
            $user->roles()->attach($admin_role);
            $user->permissions()->attach($admin_role->permissions);
        });

        User::factory()->count(50)->create()->each(function (User $user) use ($user_role){
            $user->roles()->attach($user_role);
            $user->permissions()->attach($user_role->permissions);
        });


    }
}
