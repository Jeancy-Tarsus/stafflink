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
        Schema::create('affectations', function (Blueprint $table) {

            $table->id();
            $table->string('reference')->unique();

            // Demande concernée
            $table->foreignId('demande_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Travailleur affecté
            $table->foreignId('travailleur_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Date d'affectation
            $table->date('date_affectation');

            // Date prévue de fin de mission
            $table->date('date_fin')->nullable();

            // Date réelle de retour
            $table->date('date_retour')->nullable();

            // Statut
            $table->enum('statut', [
                'En mission',
                'Terminée',
                'Suspendue'
            ])->default('En mission');

            // Observation
            $table->text('observation')->nullable();

            $table->timestamps();

            // Empêcher une double affectation
            $table->unique([
                'demande_id',
                'travailleur_id'
            ]);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affectations');
    }
};
