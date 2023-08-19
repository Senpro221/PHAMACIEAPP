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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->id();
            $table->text('nom',55);
            $table->string('image',255);
            $table->integer('quantite');
            $table->integer('quantiteMin');
            $table->integer('statut')->nullable();
            $table->string('categorie');
            $table->integer('prix_unitaire');
            $table->String('dlc');
            $table->string('libelle', 255);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('id_cat')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('id_cat')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};
