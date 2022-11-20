<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Administrador']);
        $role2 = Role::create(['name'=>'Empleado']);

        Permission::create(['name'=>'producto'])->syncRoles([$role1, $role2]);

        Permission::create(['name'=>'producto.create'])->syncRoles([$role1, $role2]);;
        Permission::create(['name'=>'producto.index']);
        Permission::create(['name'=>'producto.edit']);
        Permission::create(['name'=>'producto.destroy']);

    }
}
