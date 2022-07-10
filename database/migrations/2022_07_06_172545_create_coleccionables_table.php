<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColeccionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coleccionables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('coleccionable_photo_path', 2048)->nullable();

            $table->foreignId('coleccionable_tipo')->references('id')->on('coleccionable_tipos')
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
        Schema::dropIfExists('coleccionables');
    }
}
