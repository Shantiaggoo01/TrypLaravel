<?php

namespace Database\Seeders;

use App\Models\TipoProveedor;
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

        $empleado = new User;
        $empleado->name = 'Empleado';
        $empleado->documento = '1234567890';
        $empleado->apellido = 'Empleado';
        $empleado->telefono = 'Empleado';
        $empleado->direccion = 'Empleado';
        $empleado->email = 'empleado@gmail.com';
        $empleado->password = bcrypt('12345678');
        $empleado->image = null;
        $empleado->save();

        $empleadoRol = Role::create(['name' => 'Empleado']);

        $permisos = Permission::whereIn('name', [
            'ver-proveedor',
            'editar-usuario',
            'crear-proveedor',
            'ver-insumos',
            'ver-compras',
            'Crear-Compra',
            'ver-venta',
            'crear-venta',
            'ver-cliente',
            'editar-cliente',
            'ver-producto',
            'crear-producto',
            'editar-producto',
            'ver-produccion',
            'crear-produccion',
            'Ver-Menu-Compras',
            'Ver-Menu-Ventas',
            'Ver-Menu-Produccion',
            'Ver-Menu-Reportes',
        ])->get();

        $empleadoRol->syncPermissions($permisos);

        $empleado->assignRole($empleadoRol);

        $rol = Role::create(['name' => 'Administrador']);

        $permisos = Permission::pluck('id', 'id')->all();

        $rol->syncPermissions($permisos);

        $admin->assignRole(['Administrador']);


        // codigod e santi 


        $tipoproveedor = TipoProveedor::create([
            'nombre' => 'Persona Natural',
            'descripcion' => 'Persona del común',
        ]);

        $tipoproveedor = TipoProveedor::create([
            'nombre' => 'Persona Jurídica',
            'descripcion' => 'Persona jurídica',
        ]);
    }
}
