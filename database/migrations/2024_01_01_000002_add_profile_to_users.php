<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable()->after('birthday');
            $table->string('avatar')->nullable()->after('bio');
            $table->string('headline')->nullable()->after('avatar');
            $table->string('website')->nullable()->after('headline');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'avatar', 'headline', 'website']);
        });
    }
};
