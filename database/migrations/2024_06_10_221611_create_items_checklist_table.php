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
        Schema::create('items_checklist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_checklist');
            $table->foreign('id_checklist')->references('id')->on('checklists')->onUpdate('cascade')->onDelete('cascade');
            $table->string('pregunta');
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
        Schema::dropIfExists('items_checklist');
    }
};
