<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nit');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('banco');
            $table->string('cuenta');
            $table->string('estado')->default('Activo'); //<!-- agregue esto para el estado es el campo de la base de datos  -->
            $table->bigInteger('idtipo_proveedor')->unsigned();
            $table->foreign('idtipo_proveedor')->references('id')->on('tipo_proveedor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
