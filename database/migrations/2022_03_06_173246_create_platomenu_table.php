<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatomenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platomenu', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50)->required();
            $table->date('fecha')->required();
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
        Schema::dropIfExists('_platomenu');
    }
}
