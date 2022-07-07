<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracteristicasColeccionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristicas_coleccionables', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->foreignId('coleccionable')->references('id')->on('coleccionables')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('caracteristica')->references('id')->on('caracteristicas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('caracteristicas_coleccionables');
    }
}
