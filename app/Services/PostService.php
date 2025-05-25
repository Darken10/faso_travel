<?php

namespace App\Services;

use App\Models\Post\Post;
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

}
