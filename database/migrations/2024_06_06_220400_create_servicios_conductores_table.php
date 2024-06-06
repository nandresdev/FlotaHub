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
        Schema::create('servicios_conductores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_servicios')->nullable();
            $table->unsignedBigInteger('id_conductores')->nullable();
            $table->foreign("id_servicios")->references("id")->on("servicios")->onUpdate("cascade");
            $table->foreign("id_conductores")->references("id")->on("conductores")->onUpdate("cascade");
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('servicios_conductores');
    }
};