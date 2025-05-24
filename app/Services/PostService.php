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
}
