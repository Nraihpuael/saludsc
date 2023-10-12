<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadiaEnfermedadSintomaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadia_enfermedad_sintoma', function (Blueprint $table) {
            $table->unsignedBigInteger('estadia_enfermedad_id');
            $table->unsignedBigInteger('sintoma_id');
            $table->timestamps();
            $table->foreign('estadia_enfermedad_id')->references('id')->on('estadia_enfermedads')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('sintoma_id')->references('id')->on('sintomas')->onUpdate('cascade')
            ->onDelete('cascade');
            // $table->primary(['estadia_enfermedad_id','sintoma_id']);
            $table->primary(['estadia_enfermedad_id', 'sintoma_id'], 'pk_estadia_enf_sintoma');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadia_enfermedad_sintoma');
    }
}
