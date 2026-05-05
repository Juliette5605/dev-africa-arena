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
            // Le slug servira à avoir une URL propre (ex: /vote/juliette-alokpa)
            $table->string('slug')->nullable()->unique()->after('email');
            
            // Le boolean pour activer/désactiver l'affichage du lien côté participant
            $table->boolean('vote_link_active')->default(false)->after('finaliste');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn(['slug', 'vote_link_active']);
        });
    }
};