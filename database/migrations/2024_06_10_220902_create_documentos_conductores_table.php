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
        Schema::create('documentos_conductores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_documento_servicio')->nullable();
            $table->unsignedBigInteger('id_conductores')->nullable();
            $table->foreign('id_documento_servicio')->references('id')->on('documentos_servicios')->onUpdate('cascade');
            $table->foreign('id_conductores')->references('id')->on('conductores')->onUpdate('cascade');
            $table->date('fecha_vencimiento')->nullable();
            $table->string('estado_validacion')->default('pendiente'); // Estado de validación
            $table->unsignedBigInteger('validado_por')->nullable(); // Usuario que valida el documento
            $table->foreign('validado_por')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('documentos_conductores');
    }
};
