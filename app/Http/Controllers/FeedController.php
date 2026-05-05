<?php

namespace App\Http\Controllers;

use App\Models\Follow; 
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\PostMedia;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ajouté pour Intelephense
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FeedController extends Controller
{
    // ── FIL D'ACTUALITÉ ───────────────────────────────────────────────────
    public function index(): View
    {
        $user = Auth::user(); // Utilisation de la Façade Auth

        // Récupérer les IDs des personnes suivies
        $followingIds = Follow::where('follower_id', $user->id)
            ->pluck('following_id')
            ->push($user->id);

        $posts = Post::with(['user', 'media', 'likes', 'comments.user'])
            ->whereIn('user_id', $followingIds)
            ->orWhere('visibility', 'public')
            ->latest()
            ->paginate(12);

        $suggestions = User::whereNotIn('id', $followingIds)
            ->where('id', '!=', $user->id)
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(5)
            ->get();

        return view('feed.feed-index', compact('posts', 'suggestions'));
    }

    // ── LIKE / UNLIKE ─────────────────────────────────────────────────────
    public function like(Request $request, Post $post): JsonResponse
    {
        $userId = Auth::id();
        $reaction = $request->input('reaction', 'like');
        
        $existing = PostLike::where('post_id', $post->id)
                            ->where('user_id', $userId)
                            ->first();

        if ($existing) {
            $existing->delete();
            $post->decrement('likes_count');
            $liked = false;
        } else {
            PostLike::create([
                'post_id'  => $post->id,
                'user_id'  => $userId,
                'reaction' => $reaction,
            ]);
            $post->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'liked'       => $liked,
            'likes_count' => $post->fresh()->likes_count,
        ]);
    }

    // ── COMMENTER ─────────────────────────────────────────────────────────
    public function comment(Request $request, Post $post): JsonResponse
    {
        $request->validate(['content' => 'required|string|max:1000']);

        $comment = PostComment::create([
            'post_id'   => $post->id,
            'user_id'   => Auth::id(),
            'parent_id' => $request->parent_id,
            'content'   => $request->content,
        ]);

        $post->increment('comments_count');
        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'id'         => $comment->id,
                'content'    => $comment->content,
                'user_name'  => $comment->user->fullName(),
                'user_init'  => $comment->user->initials(),
                'avatar_url' => $comment->user->avatarUrl(),
                'created_at' => $comment->created_at->diffForHumans(),
            ],
            'comments_count' => $post->fresh()->comments_count,
        ]);
    }

    // ── SUIVRE / NE PLUS SUIVRE ────────────────────────────────────────────
    public function follow(User $user): JsonResponse
    {
        $myId = Auth::id();
        abort_if($myId === $user->id, 403);

        $existing = Follow::where('follower_id', $myId)
                          ->where('following_id', $user->id)
                          ->first();

        if ($existing) {
            $existing->delete();
            $following = false;
        } else {
            Follow::create([
                'follower_id'  => $myId,
                'following_id' => $user->id,
            ]);
            $following = true;
        }

        return response()->json([
            'following'       => $following,
            'followers_count' => $user->fresh()->followersCount(),
        ]);
    }

    // ── PROFIL PUBLIC ─────────────────────────────────────────────────────
    public function profile(User $user): View
    {
        $posts = Post::with(['media', 'likes', 'comments'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(9);

        $isFollowing = Auth::check() && Follow::where('follower_id', Auth::id())
            ->where('following_id', $user->id)
            ->exists();

        return view('feed.profile-public', compact('user', 'posts', 'isFollowing'));
    }
}