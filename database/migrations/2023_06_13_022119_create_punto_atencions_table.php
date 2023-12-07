<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntoAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_atencions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('red')->nullable();
            $table->string('distrito')->nullable();
            $table->text('ubicacion')->nullable();
            $table->decimal('latitud', 10, 6)->default('-17.795768')->nullable();
            $table->decimal('longitud', 10, 6)->default('-63.167202')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->integer('num_camillas')->nullable();
            $table->integer('num_cuartos')->nullable();
            $table->unsignedBigInteger('id_tipo_punto')->nullable();
            $table->foreign('id_tipo_punto')->references('id')->on('tipo_puntos')->onUpdate('cascade')
            ->onDelete('cascade')->nullable();
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
        Schema::dropIfExists('punto_atencions');
    }
}
