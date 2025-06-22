<?php

namespace App\Services\V2;

use App\Models\Post\Like;
use App\Models\Post\Post;
use App\Models\Post\Comment;
use App\Models\Post\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    /**
     * Get all articles with pagination
     *
     * @param int $perPage
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllArticles(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = Post::with(['user', 'category', 'comments', 'likes']);
        
        // Appliquer les filtres
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        if (isset($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('content', 'like', '%' . $filters['search'] . '%');
            });
        }
        
        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }
    
    /**
     * Get article by ID
     *
     * @param int $id
     * @return Post
     */
    public function getArticleById(int $id): Post
    {
        return Post::with(['user', 'category', 'comments.user', 'likes.user'])
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
        
        // Vérifier que l'utilisateur est le propriétaire
        if ($article->user_id !== Auth::id()) {
            throw new \Exception('Vous n\'êtes pas autorisé à modifier cet article');
        }
        
        $article->title = $data['title'] ?? $article->title;
        $article->content = $data['content'] ?? $article->content;
        $article->category_id = $data['category_id'] ?? $article->category_id;
        
        if ($image) {
            // Supprimer l'ancienne image si elle existe
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
        
        // Vérifier que l'utilisateur est le propriétaire
        if ($article->user_id !== Auth::id()) {
            throw new \Exception('Vous n\'êtes pas autorisé à supprimer cet article');
        }
        
        // Supprimer l'image si elle existe
        if ($article->image && Storage::disk('public')->exists($article->image)) {
            Storage::disk('public')->delete($article->image);
        }
        
        // Supprimer les commentaires et likes associés
        $article->comments()->delete();
        $article->likes()->delete();
        
        return $article->delete();
    }
    
    /**
     * Toggle like on an article
     *
     * @param int $articleId
     * @return array
     */
    public function toggleLike(int $articleId): array
    {
        $article = Post::findOrFail($articleId);
        $userId = Auth::id();
        
        $existingLike = Like::where('post_id', $articleId)
            ->where('user_id', $userId)
            ->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $action = 'unliked';
        } else {
            $like = new Like();
            $like->post_id = $articleId;
            $like->user_id = $userId;
            $like->save();
            $action = 'liked';
        }
        
        $likesCount = Like::where('post_id', $articleId)->count();
        
        return [
            'action' => $action,
            'likes_count' => $likesCount
        ];
    }
    
    /**
     * Add comment to an article
     *
     * @param int $articleId
     * @param string $content
     * @return Comment
     */
    public function addComment(int $articleId, string $content): Comment
    {
        $article = Post::findOrFail($articleId);
        
        $comment = new Comment();
        $comment->post_id = $articleId;
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
        $comment = Comment::findOrFail($commentId);
        
        // Vérifier que l'utilisateur est le propriétaire du commentaire ou de l'article
        $article = Post::findOrFail($comment->post_id);
        
        if ($comment->user_id !== Auth::id() && $article->user_id !== Auth::id()) {
            throw new \Exception('Vous n\'êtes pas autorisé à supprimer ce commentaire');
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
        return Category::all();
    }
}
