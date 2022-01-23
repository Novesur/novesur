<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapeletasalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papeletasalida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('fecha')->required();
            $table->time('horasalida')->required();
            $table->time('horaretorno')->required();
            $table->unsignedBigInteger('motivopapeletasalida_id');
            $table->foreign('motivopapeletasalida_id')->references('id')->on('motivopapeletasalida');
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estadoprod');
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
        Schema::dropIfExists('papeletasalida');
    }
}
