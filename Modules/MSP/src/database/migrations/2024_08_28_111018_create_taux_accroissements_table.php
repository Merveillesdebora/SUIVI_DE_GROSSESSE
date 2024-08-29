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
        Schema::create('taux_accroissements', function (Blueprint $table) {
            $table->id(); 
            $table->decimal('taux_ap', 8, 2)->nullable(); 
            $table->enum('statut_taux_ap', ['actif', 'inactif'])->nullable(); 
            $table->date('date_valeur')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taux_accroissements');
    }
};
