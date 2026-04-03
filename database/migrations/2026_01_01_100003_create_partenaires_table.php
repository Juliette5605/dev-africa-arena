<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('partenaires', function (Blueprint $table) {
            $table->id();
            $table->string('responsable');
            $table->string('entreprise');
            $table->string('telephone');
            $table->enum('type', ['financier','technique','sponsor']);
            $table->string('pack')->nullable();
            $table->string('type_apport')->nullable();
            $table->string('niveau_sponsor')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('partenaires'); }
};
