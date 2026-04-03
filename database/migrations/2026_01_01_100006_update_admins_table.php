<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('admins', function (Blueprint $table) {
            // role: 'super' ou 'sub'
            $table->enum('role', ['super', 'sub'])->default('super')->after('email');
            // delegation: si true, le sub-admin peut modifier/supprimer
            $table->boolean('can_edit')->default(false)->after('role');
            // qui a créé ce compte (super admin only)
            $table->foreignId('created_by')->nullable()->constrained('admins')->nullOnDelete()->after('can_edit');
        });
    }

    public function down(): void {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['role', 'can_edit', 'created_by']);
        });
    }
};
