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
            'name' => 'Super_Administrador',
            'documento' => '1017253837',
            'apellido' => 'Super_Administrador',
            'telefono' => 'Super_Administrador',
            'direccion' => 'Super_Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'image' => null,

        ]);

        $rol = Role::create(['name' => 'Administrador']);


        $permisos = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permisos);

        $admin->assignRole(['Administrador']);
    }
}
