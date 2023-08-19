<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appartenirs', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_panier'); 
            $table->unsignedBigInteger('id_medoc');
            $table->integer('quantites');
            $table->timestamps();
            $table->foreign('id_panier')->references('id')->on('paniers');
            $table->foreign('id_medoc')->references('id')->on('medicaments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartenirs');
    }
};
