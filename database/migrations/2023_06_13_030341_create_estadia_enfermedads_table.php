<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadiaEnfermedadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadia_enfermedads', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ini')->default(date('Y-m-d'));
            $table->date('fecha_fin')->nullable();
            $table->text('detalle')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('enfermedad_id');
            $table->foreign('enfermedad_id')->references('id')->on('enfermedad_virals')->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('estadia_enfermedable_id');
            $table->string('estadia_enfermedable_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadia_enfermedads');
    }
}
