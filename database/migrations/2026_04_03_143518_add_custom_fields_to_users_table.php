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
        Schema::table('users', function (Blueprint $table) {
            // On ajoute les nouveaux tiroirs dans la table users
            $table->string('first_name')->after('id')->nullable(); // Prénom
            $table->string('last_name')->after('first_name')->nullable(); // Nom
            $table->date('birthday')->after('email')->nullable(); // Date de naissance
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // On retire les colonnes si on annule la migration
            $table->dropColumn(['first_name', 'last_name', 'birthday']);
        });
    }
};