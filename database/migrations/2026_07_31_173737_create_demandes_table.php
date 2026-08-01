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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();

            $table->string('reference')->unique();

            // Client concerné
            $table->foreignId('client_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();

            // Métier demandé
            $table->foreignId('metier_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();

            // Nombre de travailleurs demandés
            $table->unsignedInteger('nombre');

            // Dates
            $table->date('date_debut');
            $table->date('date_fin')->nullable();

            // Priorité
            $table->enum('urgence', ['Normale', 'Urgente', 'Très urgente'])->default('Normale');

            // État de la demande
            $table->enum('statut', ['En attente', 'En cours', 'Partiellement satisfaite', 'Terminée', 'Annulée'])->default('En attente');

            // Informations complémentaires
            $table->unsignedInteger('nombre_affectes')->default(0);
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
