<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->tinyInteger('age');
            $table->enum('niveau', ['Junior','Intermédiaire','Senior']);
            $table->string('pays');
            $table->string('expertise');
            $table->string('diplome');
            $table->text('motivation');
            $table->text('vision');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('candidatures'); }
};
