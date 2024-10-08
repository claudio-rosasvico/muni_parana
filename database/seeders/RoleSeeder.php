<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'editor']);
        $role3 = Role::create(['name' => 'visitante']);

        $user = User::find(1);
        $user->assignRole('administrador');
    }
}
