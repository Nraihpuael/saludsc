<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_ingreso')->default(date('Y-m-d')); 
            $table->string('ap_paterno', 50)->nullable();
            $table->string('name',50)->nullable();
            $table->string('genero',50)->nullable();
            $table->string('edad',15)->nullable();
            $table->text('departamento')->nullable();
            $table->text('localidad')->nullable();
            $table->text('barrio')->nullable();
            $table->string('telefono',20)->nullable();  
            $table->string('hospitalizado')->nullable();
            $table->string('punto_atencion')->nullable();
            $table->date('fecha_ini')->nullable();
            $table->string('sem')->nullable();
            $table->date('fecha_toma')->nullable();
            $table->string('dias')->nullable();
            $table->string('resultados')->nullable();
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('estadia_enfermedad_id')->nullable();
            $table->foreign('estadia_enfermedad_id')->references('id')->on('estadia_enfermedads')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('laboratorios');
    }
}
