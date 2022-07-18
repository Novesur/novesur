<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallemenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallemenu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menu');
            $table->integer('cant_entrada')->required();
            $table->unsignedBigInteger('plato_entrada_id');
            $table->foreign('plato_entrada_id')->references('id')->on('plato_entrada');
            $table->string('observacionEntrada',150)->nullable();
            $table->integer('cant_segundo')->required();
            $table->unsignedBigInteger('plato_segundo_id');
            $table->foreign('plato_segundo_id')->references('id')->on('plato_segundo');
            $table->string('observacionSegundo',150)->nullable();
            $table->integer('cant_extra')->required();
            $table->unsignedBigInteger('plato_extra_id');
            $table->foreign('plato_extra_id')->references('id')->on('plato_extra');
            $table->string('observacionExtra',150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallemenu');
    }
}
