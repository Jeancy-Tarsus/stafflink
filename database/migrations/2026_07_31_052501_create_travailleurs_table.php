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
        Schema::create('travailleurs', function (Blueprint $table) {
            $table->id();
            // Informations personnelles
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe', ['Masculin', 'Féminin']);
            $table->date('date_naissance');

            // Coordonnées
            $table->string('telephone')->unique();
            $table->string('email')->nullable();
            $table->string('adresse');

            // Métier
            $table->foreignId('metier_id')
                  ->constrained('metiers')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // Informations professionnelles
            $table->string('experience')->nullable();
            $table->decimal('salaire_souhaite', 10, 2)->nullable();

            // Disponibilité
            $table->boolean('disponible')->default(true);

            // Statut
            $table->boolean('actif')->default(true);

            // Photo
            $table->string('photo')->nullable();

            // Observations
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travailleurs');
    }
};
