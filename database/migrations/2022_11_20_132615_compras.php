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
        Schema::create('Compras', function (Blueprint $table) {
            $table->bigIncrements('nFactura');
            $table->bigInteger('id_proveedor')->unsigned();
            $table->bigInteger('id_insumo')->unsigned();
            $table->double('totalCompra');
            $table->double('iva',);
            $table->timestamps();

            $table->foreign('id_proveedor')->references('id')->on('Proveedores');
            $table->foreign('id_insumo')->references('id')->on('Insumos');
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
