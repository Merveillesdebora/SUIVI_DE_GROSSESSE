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
        Schema::create('taux_annuel_indicateurs', function (Blueprint $table) {
            $table->id(); 
            $table->decimal('taux_indicateur', 8, 2); 
            $table->date('date_valeur'); 
            $table->enum('statut_taux_indicateur', ['actif', 'inactif']); 
            $table->integer('id_indicateur');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taux_annuel_indicateurs');
    }
};
