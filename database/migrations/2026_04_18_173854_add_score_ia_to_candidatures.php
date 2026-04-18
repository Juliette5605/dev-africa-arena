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
        Schema::table('candidatures', function (Blueprint $table) {
            $table->tinyInteger('score_ia')->nullable()->after('statut');      // Score IA 1-5
            $table->text('analyse_ia')->nullable()->after('score_ia');          // Analyse IA détaillée
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn(['score_ia', 'analyse_ia']);
        });
    }
};
