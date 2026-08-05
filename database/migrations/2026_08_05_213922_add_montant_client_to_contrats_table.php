<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contrats', function (Blueprint $table) {

            $table->decimal('montant_client', 12, 2)
                ->default(0)
                ->after('salaire');
        });
    }

    public function down(): void
    {
        Schema::table('contrats', function (Blueprint $table) {

            $table->dropColumn('montant_client');
        });
    }
};
