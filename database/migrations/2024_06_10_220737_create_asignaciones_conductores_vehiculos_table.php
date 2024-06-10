<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones_conductores_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_conductor');
            $table->unsignedBigInteger('id_vehiculo');
            $table->date('fecha_asignacion');
            $table->date('fecha_fin_asignacion')->nullable();
            $table->timestamps();
            
            $table->foreign('id_conductor')->references('id')->on('conductores')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_vehiculo')->references('id')->on('vehiculos')->onUpdate('cascade')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('asignaciones_conductores_vehiculos');
    }
};
