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
        //
        Schema::create('producciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idProducto')->unsigned();
            $table->foreign('idProducto')->references('idproducto')->on('productos');
            $table->Date('FechaProduccion');
            $table->Date('FechaVencimiento');
            $table->double('Total', 60);
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
