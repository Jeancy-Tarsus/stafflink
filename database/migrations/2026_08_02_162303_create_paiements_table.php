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
        Schema::create('paiements', function (Blueprint $table) {

            $table->id();

            // Référence du paiement
            $table->string('reference')->unique();

            // Contrat concerné
            $table->foreignId('contrat_id')
                ->constrained()
                ->cascadeOnDelete();

            // Date de paiement
            $table->date('date_paiement');

            // Montant versé
            $table->decimal('montant', 12, 2);

            // Mode de paiement
            $table->enum('mode_paiement', [
                'Espèces',
                'Virement bancaire',
                'Chèque',
                'Mobile Money'
            ]);

            // Référence bancaire ou transaction
            $table->string('reference_paiement')->nullable();

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
        Schema::dropIfExists('paiements');
    }
};
