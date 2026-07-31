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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            // Informations générales
            $table->string('nom');
            $table->enum('type', ['Entreprise', 'Particulier']);
            $table->string('responsable');
            $table->string('fonction')->nullable();

            // Coordonnées
            $table->string('telephone')->unique();
            $table->string('telephone_secondaire')->nullable();
            $table->string('email')->nullable();
            $table->string('adresse');
            $table->string('ville');

            // Informations professionnelles
            $table->string('secteur_activite');
            $table->string('rccm')->nullable();
            $table->string('niu')->nullable();

            // Statut
            $table->boolean('actif')->default(true);

            // Observation
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
