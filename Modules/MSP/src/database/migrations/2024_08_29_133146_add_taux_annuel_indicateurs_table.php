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
        Schema::table('taux_annuel_indicateurs', function (Blueprint $table) {

            $table->unsignedBigInteger("id_indicateur")->nullable()->after("statut_taux_indicateur");
            $table->foreign("id_indicateur")->references("id")->on("indicateurs")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns("taux_annuel_indicateurs","id_indicateur");
    }
};
