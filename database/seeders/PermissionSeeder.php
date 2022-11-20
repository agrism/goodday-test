<?php

namespace Database\Seeders;

use App\Enums\PermissionEnums;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Permission::query()->updateOrCreate([
            'name' => PermissionEnums::NEWS_MANAGE->value,
            'guard_name' => 'web',
        ]);

        Permission::query()->updateOrCreate([
            'name' => PermissionEnums::NEWS_MANAGE->value,
            'guard_name' => 'web',
        ]);

        Permission::query()->updateOrCreate([
            'name' => PermissionEnums::BLOG_VIEW->value,
            'guard_name' => 'web',
        ]);

        Permission::query()->updateOrCreate([
            'name' => PermissionEnums::BLOG_MANAGE->value,
            'guard_name' => 'web',
        ]);
    }
}
