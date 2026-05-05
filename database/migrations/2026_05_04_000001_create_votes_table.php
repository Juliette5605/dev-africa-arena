<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained()->onDelete('cascade');
            $table->string('voter_name');
            $table->string('voter_email')->nullable();
            $table->string('voter_phone');
            $table->enum('voter_type', ['public', 'sponsor', 'jury']);
            $table->integer('amount');       // montant en FCFA (100, 200, 500, 1000, 2000, 5000, 10000)
            $table->integer('points');       // points accordés (amount / 100)
            $table->enum('payment_method', ['flooz', 'tmoney']);
            $table->string('transaction_ref')->nullable(); // référence de paiement
            $table->enum('status', ['pending', 'confirmed', 'failed'])->default('pending');
            $table->string('ip_address')->nullable();
            $table->string('vote_token')->unique(); // token unique anti-fraude
            $table->timestamps();
        });

        Schema::create('vote_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidature_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique();       // lien standard /vote/jean-dupont-123
            $table->string('tiktok_url')->nullable(); // lien TikTok si le candidat en a un
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vote_links');
        Schema::dropIfExists('votes');
    }
};
