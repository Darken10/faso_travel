<?php

namespace App\Services;

use App\Models\Compagnie\Compagnie;
use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

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
        return (bool)$post->likes()->create(['user_id' => auth()->id()]);
    }
    public function dislikePost(Post $post): bool
    {
        return $post->likes()->where('user_id', auth()->id())->delete() > 0;
    }

    public function isLikedByUser(Post $post): bool
    {
        return $post->likes()->where('user_id', auth()->id())->exists();
    }

    public function getPostLikes(Post $post): LengthAwarePaginator
    {
        return $post->likes()->with(['user','post'])->paginate(10);
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


    public function addComment(Post $post,array $data)
    {
        $data = request()->validate([
            'message' => 'required|string|max:255',
        ]);
        return $post->comments()->create([
            'message' => $data['message'],
            'user_id' => auth()->id(),
        ]);
    }

}
