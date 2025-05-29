<?php

namespace App\Services;

use App\Models\Compagnie\Compagnie;
use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Post\Comment;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAllPosts(): LengthAwarePaginator
    {
        return Post::with(['user', 'comments.user', 'likes','tags'])
            ->latest()
            ->paginate(10);
    }

    public function getPost(int $id): Post
    {
        return Post::with(['user', 'comments.user', 'likes', 'tags'])
            ->findOrFail($id);
    }

    public function likePost(Post $post): bool
    {
        return $post->likes()->create([
            'user_id' => Auth::id()
        ]) !== null;
    }
    public function dislikePost(Post $post): bool
    {
        return $post->likes()
            ->where('user_id', Auth::id())
            ->delete() > 0;
    }

    public function isLikedByUser(Post $post): bool
    {
        return $post->likes()
            ->where('user_id', Auth::id())
            ->exists();
    }

    public function getPostLikes(Post $post)
    {
        return $post->likes()
            ->with('user')
            ->latest()
            ->get()
            ->pluck('user');
    }

    public function getPostComments(Post $post): LengthAwarePaginator
    {
        return $post->comments()->with(['user'])->paginate(10);

    }

    public function getAllLikes(Post $post)
    {
        return $post->likes()->with(['user'])->paginate(10);
    }

    public function getAllComments(Post $post)
    {
        return $post->comments()->with(['user'])->paginate(10);
    }

    public function getPostsByUser(User $user): LengthAwarePaginator
    {
        return Post::where('user_id', $user->id)
            ->with(['user', 'comments.user', 'likes', 'tags'])
            ->latest()
            ->paginate(10);
    }

    public function getPostsByCompany(Compagnie $compagnie): LengthAwarePaginator
    {
        return Post::whereHas('user', function ($query) use ($compagnie) {
            $query->where('compagnie_id', $compagnie->id);
        })->with(['user', 'comments.user', 'likes', 'tags'])
            ->latest()
            ->paginate(10);
    }

    public function getPostsByTag(string $tag): LengthAwarePaginator
    {
        return Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('name', $tag);
        })->with(['user', 'comments.user', 'likes', 'tags'])
            ->latest()
            ->paginate(10);
    }

    public function getPostsByCategory(int $categoryId): LengthAwarePaginator
    {
        return Post::where('category_id', $categoryId)
            ->with(['user', 'comments.user', 'likes', 'tags'])
            ->latest()
            ->paginate(10);
    }

    public function getPostsBySearch(string $search): LengthAwarePaginator
    {
        return Post::where('title', 'like', '%' . $search . '%')
            ->orWhere('content', 'like', '%' . $search . '%')
            ->with(['user', 'comments.user', 'likes', 'tags'])
            ->latest()
            ->paginate(10);
    }

    public function getPostByCompagnie(Compagnie $compagnie)
    {
        return Post::whereHas('user', function ($query) use ($compagnie) {
            $query->where('compagnie_id', $compagnie->id);
        })->with(['user', 'comments.user', 'likes', 'tags'])
            ->latest()
            ->paginate(10);

    }


    public function addComment(Post $post, array $data)
    {
        return $post->comments()->create([
            'message' => $data['message'],
            'user_id' => auth()->id()
        ]);
    }
}
