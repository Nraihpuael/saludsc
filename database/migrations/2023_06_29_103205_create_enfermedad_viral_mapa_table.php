<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadViralMapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedad_viral_mapa', function (Blueprint $table) {
            $table->unsignedBigInteger('enfermedad_viral_id');
            $table->foreign('enfermedad_viral_id')->references('id')->on('enfermedad_virals')->onUpdate('cascade')->onDelete('cascade');
            
            $table->unsignedBigInteger('mapa_id');
            $table->foreign('mapa_id')->references('id')->on('mapas')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();

            $table->primary(['enfermedad_viral_id', 'mapa_id'], 'pk_enfermedad_vir_mapa');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfermedad_viral_mapa');
    }
}
