<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'=>'Administrador',
            'documento'=>'1017253837',
            'apellido'=>'Administrador',
            'telefono'=>'Administrador',
            'direccion'=>'Administrador',
            'email'=>'administrador@gmail.com',
            'password'=>bcrypt('12345678')

        ]);

        $empleado = User::create([
            'name'=>'Empleado',
            'documento'=>'1234567890',
            'apellido'=>'Empleado',
            'telefono'=>'Empleado',
            'direccion'=>'Empleado',
            'email'=>'Empleado@gmail.com',
            'password'=>bcrypt('12345678')

        ]);

       $rol = Role::create(['name'=>'Administrador']);

       $rol = Role::create(['name'=>'Empleado']);

       $permisos = Permission::pluck('id','id')->all();

       $rol->syncPermissions($permisos);

        $admin -> assignRole(['Administrador']);

        $empleado -> assignRole(['Empleado']);

    }
}
