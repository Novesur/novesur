<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallepapeletasalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallepapeletasalida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('papeletasalida_id');
            $table->foreign('papeletasalida_id')->references('id')->on('papeletasalida');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->string('contacto',150)->required();
            $table->string('fundamento',150)->required();
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
        Schema::dropIfExists('detallepapeletasalida');
    }
}
