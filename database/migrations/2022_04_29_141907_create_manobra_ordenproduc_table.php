<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManobraOrdenproducTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manobra_ordenproduc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordenproduccion_id');
            $table->foreign('ordenproduccion_id')->references('id')->on('ordenproduccion');
            $table->string('personal',150)->nullable();
            $table->integer('dias')->required();
            $table->integer('horas')->required();
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
        Schema::dropIfExists('manobra_ordenproduc');
    }
}
