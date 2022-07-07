<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetColeccionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_coleccionables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedDouble('prec_venta', 8, 2)->nullable();
            $table->unsignedDouble('prec_compra', 8, 2)->nullable();
            $table->boolean('set_intercambio')->nullable();
            $table->unsignedInteger('cant');
            $table->foreignId('coleccion')
            ->references('id')
            ->on('colecciones')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('coleccionable')
            ->references('id')
            ->on('coleccionables')
            ->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('set_coleccionables');
    }
}
