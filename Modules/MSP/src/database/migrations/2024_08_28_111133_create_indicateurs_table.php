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
        Schema::create('indicateurs', function (Blueprint $table) {
            $table->id(); 
            $table->string('nom_indicateur'); 
            $table->text('description_indicateur'); 
            $table->string('formule_de_calcul'); 
            $table->enum('etat_indicateur', ['actif', 'inactif']);
            $table->enum('type_indicateur', ['general', 'individuel']);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicateurs');
    }
};
