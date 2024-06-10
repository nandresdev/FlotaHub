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
        Schema::create('checklists_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_item_checklist');
            $table->foreign('id_item_checklist')->references('id')->on('items_checklist')->onUpdate('cascade')->onDelete('cascade');
            $table->string('estado_validacion')->default('pendiente');
            $table->unsignedBigInteger('validado_por')->nullable(); 
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
        Schema::dropIfExists('checklists_vehiculos_');
    }
};
