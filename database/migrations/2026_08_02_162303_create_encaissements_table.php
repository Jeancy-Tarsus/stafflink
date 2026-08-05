<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('encaissements', function (Blueprint $table) {

            $table->id();

            // Référence de l'encaissement
            $table->string('reference')->unique();

            // Facture concernée
            $table->foreignId('facture_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Date du paiement
            $table->date('date_encaissement');

            // Montant reçu
            $table->decimal('montant', 12, 2);

            // Mode de paiement
            $table->enum('mode_paiement', [
                'Espèces',
                'Virement bancaire',
                'Chèque',
                'Mobile Money'
            ]);

            // Référence du paiement (facultatif)
            $table->string('reference_paiement')->nullable();

            // Observation
            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encaissements');
    }
};
