<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaremisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guiaremision', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',15)->nullable();
            $table->date('fechainicio')->required();
            $table->char('ruc',11)->required();
            $table->string('puntopartida')->required();
            $table->string('puntollegada')->required();
            $table->unsignedBigInteger('motivotraslado_id')->unsigned();
            $table->foreign('motivotraslado_id')->references('id')->on('motivotraslado');
            $table->unsignedBigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacion');
            $table->string('placaconductor',10)->required();
            $table->char('dniconductor',8)->required();
            $table->decimal('pesototal',8,3)->required();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estadoprod');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('guiaremision');
    }
}
