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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->string('domaine');
            $table->string('sous_domaine')->nullable();

            $table->enum('niveau', ['debutant', 'intermediaire', 'avance']);

            $table->enum('type', [
                'qcm',
                'code_output',
                'code_bug',
                'open_question'
            ]);

            $table->text('enonce');
            $table->json('contenu')->nullable();
            $table->text('explication')->nullable();

            $table->integer('points')->default(10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};