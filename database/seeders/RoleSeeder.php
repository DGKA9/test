<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role();
        $role->roleID = Str::uuid();
        $role->roleName = 'Admin';
        $role->save();

        $role = new Role();
        $role->roleID = Str::uuid();
        $role->roleName = 'User';
        $role->save();
    }
}
