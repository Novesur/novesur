<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateOrdenproduccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenproduccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('cantidad')->required();
            $table->integer('stock')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->date('fechainicio')->required();
            $table->date('fechafinal')->required();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
           //  $table->unsignedBigInteger('material_ordenproduc_id');
           // $table->foreign('material_ordenproduc_id')->references('id')->on('material_ordenproduc');
           // $table->unsignedBigInteger('manobra_ordenproduc_id');
           // $table->foreign('manobra_ordenproduc_id')->references('id')->on('manobra_ordenproduc');
            //$table->unsignedBigInteger('otrosrequerimientos_ordenproduc_id');
            //$table->foreign('otrosrequerimientos_ordenproduc_id')->references('id')->on('otrosrequerimientos_ordenproduc');
            $table->softDeletes();
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
        Schema::dropIfExists('_ordenproduccion');
    }
}
