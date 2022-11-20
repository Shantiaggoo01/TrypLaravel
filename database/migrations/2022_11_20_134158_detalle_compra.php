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
        Schema::create('Detalle_Compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_Compra')->unsigned();
            $table->double('precio_Unitario');
            $table->double('precio_Total');
            $table->bigInteger('id_Insumos')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('id_Compra')->references('nFactura')->on('Compras');
            $table->foreign('id_Insumos')->references('id')->on('Insumos');
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
