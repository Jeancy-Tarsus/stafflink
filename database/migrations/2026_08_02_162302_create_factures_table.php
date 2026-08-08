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
        Schema::create('factures', function (Blueprint $table) {

            $table->id();

            $table->string('reference')->unique();

            $table->foreignId('contrat_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->date('date_facture');

            $table->date('date_echeance')->nullable();

            // Montant total facturé
            $table->decimal('montant', 12, 2);

            // Objet de la facture
            $table->string('objet');

            // Conditions de paiement
            $table->text('conditions_paiement')->nullable();

            $table->enum('statut', [
                'Non payée',
                'Partiellement payée',
                'Payée',
                'Annulée'
            ])->default('Non payée');

            $table->text('observation')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
