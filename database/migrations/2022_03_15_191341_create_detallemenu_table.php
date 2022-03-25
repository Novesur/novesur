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
            $table->integer('cantEntrada')->required();
            $table->unsignedBigInteger('menuentrada_id');
            $table->foreign('menuentrada_id')->references('id')->on('menuentrada');
            $table->integer('cantSegundo')->required();
            $table->unsignedBigInteger('menusegundo_id');
            $table->foreign('menusegundo_id')->references('id')->on('menusegundo');
            $table->integer('cantExtra')->required();
            $table->unsignedBigInteger('menuextra_id');
            $table->foreign('menuextra_id')->references('id')->on('menuextra');
            $table->unsignedBigInteger('tipomenu_id');
            $table->foreign('tipomenu_id')->references('id')->on('tipomenu');
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
        Schema::dropIfExists('detallemenu');
    }
}
