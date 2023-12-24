<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'User' => 'r',
            'Category' => 'c,r,u,d',
            'Article' => 'c,r,u,d',
        ];

        $mapPermission = [
            'c' => 'create',
            'r' => 'read',
            'u' => 'update',
            'd' => 'delete',
        ];
        foreach ($permissions as $item => $value) {
            foreach (explode(',', $value) as $permission) {
                $permissionValue = $mapPermission[$permission];
                $name = $item .' '. ucfirst($permissionValue);

                $permissions[] = Permission::query()->firstOrCreate([
                    'name' => $name,
                    'slug' => Str::slug($name),
                ])->id;
            }
        }
    }
}
