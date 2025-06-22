<?php

namespace App\Services;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Models\Post\PostLike;
use App\Models\Post\PostComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    /**
     * Get all articles with optional filtering
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getArticles(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Post::with(['category', 'user', 'likes', 'comments']);
        
        // Apply filters
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        if (isset($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('content', 'like', '%' . $filters['search'] . '%');
            });
        }
        
        if (isset($filters['featured']) && $filters['featured']) {
            $query->where('is_featured', true);
        }
        
        // Sort by latest by default
        $query->orderBy('created_at', 'desc');
        
        return $query->paginate($perPage);
    }

    /**
     * Get article by ID
     *
     * @param int $id
     * @return Post
     */
    public function getArticleById(int $id): Post
    {
        return Post::with(['category', 'user', 'likes', 'comments.user'])
            ->findOrFail($id);
    }

    /**
     * Create a new article
     *
     * @param array $data
     * @param UploadedFile|null $image
     * @return Post
     */
    public function createArticle(array $data, ?UploadedFile $image = null): Post
    {
        $article = new Post();
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->category_id = $data['category_id'];
        $article->user_id = Auth::id();
        $article->is_featured = $data['is_featured'] ?? false;
        
        if ($image) {
            $path = $image->store('articles', 'public');
            $article->image = $path;
        }
        
        $article->save();
        
        return $article;
    }

    /**
     * Update an article
     *
     * @param int $id
     * @param array $data
     * @param UploadedFile|null $image
     * @return Post
     */
    public function updateArticle(int $id, array $data, ?UploadedFile $image = null): Post
    {
        $article = Post::findOrFail($id);
        
        // Check if user is authorized to update this article
        if ($article->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            throw new \Exception('Unauthorized to update this article');
        }
        
        $article->title = $data['title'] ?? $article->title;
        $article->content = $data['content'] ?? $article->content;
        $article->category_id = $data['category_id'] ?? $article->category_id;
        $article->is_featured = $data['is_featured'] ?? $article->is_featured;
        
        if ($image) {
            // Delete old image if exists
            if ($article->image && Storage::disk('public')->exists($article->image)) {
                Storage::disk('public')->delete($article->image);
            }
            
            $path = $image->store('articles', 'public');
            $article->image = $path;
        }
        
        $article->save();
        
        return $article;
    }

    /**
     * Delete an article
     *
     * @param int $id
     * @return bool
     */
    public function deleteArticle(int $id): bool
    {
        $article = Post::findOrFail($id);
        
        // Check if user is authorized to delete this article
        if ($article->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            throw new \Exception('Unauthorized to delete this article');
        }
        
        // Delete image if exists
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }
        
        return $article->delete();
    }

    /**
     * Like or unlike an article
     *
     * @param int $id
     * @return array
     */
    public function toggleLike(int $id): array
    {
        $article = Post::findOrFail($id);
        $userId = Auth::id();
        
        $existingLike = PostLike::where('post_id', $id)
            ->where('user_id', $userId)
            ->first();
            
        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            PostLike::create([
                'post_id' => $id,
                'user_id' => $userId
            ]);
            $liked = true;
        }
        
        return [
            'liked' => $liked,
            'likes_count' => $article->likes()->count()
        ];
    }

    /**
     * Add a comment to an article
     *
     * @param int $id
     * @param string $content
     * @return PostComment
     */
    public function addComment(int $id, string $content): PostComment
    {
        $article = Post::findOrFail($id);
        
        $comment = new PostComment();
        $comment->post_id = $id;
        $comment->user_id = Auth::id();
        $comment->content = $content;
        $comment->save();
        
        return $comment->load('user');
    }

    /**
     * Delete a comment
     *
     * @param int $commentId
     * @return bool
     */
    public function deleteComment(int $commentId): bool
    {
        $comment = PostComment::findOrFail($commentId);
        
        // Check if user is authorized to delete this comment
        if ($comment->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            throw new \Exception('Unauthorized to delete this comment');
        }
        
        return $comment->delete();
    }

    /**
     * Get all article categories
     *
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return PostCategory::all();
    }
}
