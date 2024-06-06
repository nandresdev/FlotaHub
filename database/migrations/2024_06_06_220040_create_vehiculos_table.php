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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_vehiculo');
            $table->string('patente');
            $table->string('marca');
            $table->string('modelo');
            $table->string('combustible');
            $table->int('ano');
            $table->string('traccion');
            $table->string('color');
            $table->string('numero_motor');
            $table->string('numero_chasis');
            $table->string('kilometraje')->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
};