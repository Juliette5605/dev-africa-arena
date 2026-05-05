<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('admin_name')->nullable(); // garder le nom même si admin supprimé
            $table->string('action');                 // ex: "supprimé", "créé", "modifié"
            $table->string('subject');                // ex: "Candidature", "Message"
            $table->string('subject_detail')->nullable(); // ex: "Jean Dupont"
            $table->string('ip')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('activity_logs'); }
};
