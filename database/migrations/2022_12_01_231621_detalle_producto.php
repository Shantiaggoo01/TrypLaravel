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
        Schema::create('detalle_producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idproducto');
            $table->unsignedBigInteger('idinsumo');
            $table->integer('cantidad');
            $table->foreign('idinsumo')->references('id')->on('insumos');
            $table->foreign('idproducto')->references('idproducto')->on('productos');
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
