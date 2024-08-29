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
            $table->decimal('taux_indicateur', 8, 2)->nullable(); 
            $table->date('date_valeur')->nullable(); 
            $table->enum('statut_taux_indicateur', ['actif', 'inactif'])->nullable(); 
            $table->integer('id_indicateur')->nullable();
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
