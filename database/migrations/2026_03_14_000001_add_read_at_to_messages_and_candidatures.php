<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Messages : lu/non lu
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->timestamp('read_at')->nullable()->after('message');
        });
        // Candidatures : lu/non lu
        Schema::table('candidatures', function (Blueprint $table) {
            $table->timestamp('read_at')->nullable()->after('vision');
        });
    }
    public function down(): void {
        Schema::table('contact_messages', function (Blueprint $table) { $table->dropColumn('read_at'); });
        Schema::table('candidatures',     function (Blueprint $table) { $table->dropColumn('read_at'); });
    }
};
