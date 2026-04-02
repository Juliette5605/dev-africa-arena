<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // nom affiché
            $table->string('filename');       // nom stocké
            $table->string('path');           // chemin public
            $table->string('type');           // image/pdf/etc
            $table->unsignedBigInteger('size'); // en bytes
            $table->string('category')->default('general'); // logo/hero/partenaire/general
            $table->foreignId('uploaded_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('media'); }
};
