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
        Schema::create('documentos_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_servicios')->nullable();
            $table->foreign("id_servicios")->references("id")->on("servicios")->onUpdate("cascade");
            $table->string('nombre');
            $table->string('tipo');
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
        Schema::dropIfExists('documentos_servicios');
    }
};
