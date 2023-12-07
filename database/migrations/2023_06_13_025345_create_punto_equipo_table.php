<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntoEquipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_equipo', function (Blueprint $table) {
            $table->unsignedBigInteger('equipo_id');
            $table->unsignedBigInteger('punto_atencion_id');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('punto_atencion_id')->references('id')->on('punto_atencions')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('equipo_id')->references('id')->on('equipos')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->primary(['equipo_id', 'punto_atencion_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('punto_equipo');
    }
}
