<?php

use App\Ordencompra;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleordencomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleordencompras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordencompras_id');
            $table->foreign('ordencompras_id')->references('id')->on('ordencompras');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->decimal('cantidad',8,2)->required();
            //$table->integer('cantidad')->required();
            $table->integer('cantidadKardex');
            $table->unsignedBigInteger('unidmedida_id')->required();
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
           /*  $table->decimal('punit', 8, 4)->required(); */
            $table->double('punit');
            $table->enum('estado',[Ordencompra::ATENDIDO,Ordencompra::ANULADO])->default(Ordencompra::ATENDIDO);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleordencompras');
    }
}
