<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_selection');
            $table->date('date_finale');
            $table->string('lieu')->default('Lomé, Togo');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('editions'); }
};
