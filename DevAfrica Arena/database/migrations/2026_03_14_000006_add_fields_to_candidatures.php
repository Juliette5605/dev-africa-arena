<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->tinyInteger('note')->nullable()->after('read_at');        // 1-5
            $table->text('commentaire_admin')->nullable()->after('note');     // annotation interne
            $table->boolean('finaliste')->default(false)->after('commentaire_admin');
            $table->string('statut')->default('en_attente')->after('finaliste'); // en_attente/retenu/refuse
        });
    }
    public function down(): void {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn(['note','commentaire_admin','finaliste','statut']);
        });
    }
};
