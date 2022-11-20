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
        Schema::create('insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre', 60);
            $table->string('TipoCantidad', 60);
            $table->double('Precio', 60);
            $table->string('Estado', 30);
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
