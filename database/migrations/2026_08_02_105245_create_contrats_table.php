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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();

            // Référence
            $table->string('reference')->unique();

            // Affectation concernée
            $table->foreignId('affectation_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Date de signature
            $table->date('date_signature');

            // Début du contrat
            $table->date('date_debut');

            // Fin du contrat
            $table->date('date_fin')->nullable();

            // Salaire convenu
            $table->decimal('salaire', 12, 2)->default(0);

            // Statut
            $table->enum('statut', [
                'Actif',
                'Terminé',
                'Résilié'
            ])->default('Actif');

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
        Schema::dropIfExists('contrats');
    }
};
