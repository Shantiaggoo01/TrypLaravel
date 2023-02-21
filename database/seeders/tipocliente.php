<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoCliente;

class TipoClientes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoCliente = TipoCliente::create([
            'Nombre'=>'Persona Natural',
            
        ]);

        $tipoCliente = TipoCliente::create([
            'Nombre'=>'Persona Jurídica',
           
        ]);
    }
}
