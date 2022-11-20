<?php

namespace Database\Seeders;

use App\Enums\RoleEnums;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Role::query()->updateOrCreate([
            'name' => RoleEnums::USER->value,
            'guard_name' => 'web',
        ]);

        Role::query()->updateOrCreate([
            'name' => RoleEnums::ADMIN->value,
            'guard_name' => 'web',
        ]);
    }
}
