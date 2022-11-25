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
        $usuario = User::create([
            'name'=>'Jean Paul',
            'documento'=>'1017253837',
            'apellido'=>'Estrada Gomez',
            'telefono'=>'000000',
            'direccion'=>'000000',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('12345678')

        ]);

       $rol = Role::create(['name'=>'Administrador']);

       $permisos = Permission::pluck('id','id')->all();

       $rol->syncPermissions($permisos);

        $usuario -> assignRole(['Administrador']);

    }
}
