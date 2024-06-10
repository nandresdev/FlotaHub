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
            $table->string('patente')->unique();
            $table->string('marca');
            $table->string('modelo');
            $table->string('combustible');
            $table->year('ano');
            $table->string('traccion');
            $table->string('color');
            $table->string('numero_motor')->unique();
            $table->string('numero_chasis')->unique();
            $table->integer('kilometraje')->nullable();
            $table->string('estado')->default('operativo'); 
            $table->string('foto')->nullable(); 
            $table->unsignedBigInteger('id_servicios')->nullable();
            $table->foreign('id_servicios')->references('id')->on('servicios')->onUpdate('cascade');
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
