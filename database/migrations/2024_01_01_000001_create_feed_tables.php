<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── POSTS ──────────────────────────────────────────────────────────
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['text', 'image', 'video', 'article', 'project'])->default('text');
            $table->text('content');
            $table->string('title')->nullable();          // Pour les articles / projets
            $table->string('cover_image')->nullable();    // Image de couverture article
            $table->string('tech_stack')->nullable();     // Ex: "Laravel, React, TailwindCSS"
            $table->string('project_url')->nullable();    // Lien vers le projet
            $table->string('github_url')->nullable();     // Lien GitHub
            $table->enum('visibility', ['public', 'members'])->default('public');
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('comments_count')->default(0);
            $table->unsignedInteger('shares_count')->default(0);
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'created_at']);
            $table->index('type');
        });

        // ── POST MEDIA (images/vidéos attachées) ───────────────────────────
        Schema::create('post_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['image', 'video']);
            $table->string('path');                      // Chemin stockage
            $table->string('thumbnail')->nullable();     // Miniature vidéo
            $table->unsignedTinyInteger('order')->default(0);
            $table->timestamps();
        });

        // ── LIKES ──────────────────────────────────────────────────────────
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('reaction', ['like', 'fire', 'clap', 'rocket'])->default('like');
            $table->timestamps();

            $table->unique(['post_id', 'user_id']);  // Un seul like par user
        });

        // ── COMMENTAIRES ───────────────────────────────────────────────────
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('post_comments')->cascadeOnDelete(); // Réponses
            $table->text('content');
            $table->unsignedInteger('likes_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // ── FOLLOWS ────────────────────────────────────────────────────────
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('following_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['follower_id', 'following_id']);
            $table->index('following_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
        Schema::dropIfExists('post_comments');
        Schema::dropIfExists('post_likes');
        Schema::dropIfExists('post_media');
        Schema::dropIfExists('posts');
    }
};
