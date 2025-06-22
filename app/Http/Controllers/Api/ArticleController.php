<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Get all articles with optional filtering
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = [
                'category_id' => $request->input('category_id'),
                'search' => $request->input('search'),
                'featured' => $request->boolean('featured'),
            ];

            $perPage = $request->input('per_page', 15);
            $articles = $this->articleService->getArticles($filters, $perPage);
            
            return response()->json([
                'status' => 'success',
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get article by ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $article = $this->articleService->getArticleById($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Create a new article
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:post_categories,id',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            $article = $this->articleService->createArticle(
                $request->only(['title', 'content', 'category_id', 'is_featured']),
                $request->file('image')
            );
            
            return response()->json([
                'status' => 'success',
                'message' => 'Article created successfully',
                'data' => $article
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an article
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'category_id' => 'sometimes|exists:post_categories,id',
            'is_featured' => 'sometimes|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            $article = $this->articleService->updateArticle(
                $id,
                $request->only(['title', 'content', 'category_id', 'is_featured']),
                $request->file('image')
            );
            
            return response()->json([
                'status' => 'success',
                'message' => 'Article updated successfully',
                'data' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getMessage() === 'Unauthorized to update this article' ? 403 : 500);
        }
    }

    /**
     * Delete an article
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->articleService->deleteArticle($id);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Article deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getMessage() === 'Unauthorized to delete this article' ? 403 : 500);
        }
    }

    /**
     * Like or unlike an article
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleLike($id)
    {
        try {
            $result = $this->articleService->toggleLike($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add a comment to an article
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        try {
            $comment = $this->articleService->addComment($id, $request->content);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Comment added successfully',
                'data' => $comment
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a comment
     *
     * @param int $commentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteComment($commentId)
    {
        try {
            $this->articleService->deleteComment($commentId);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Comment deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getMessage() === 'Unauthorized to delete this comment' ? 403 : 500);
        }
    }

    /**
     * Get all article categories
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories()
    {
        try {
            $categories = $this->articleService->getCategories();
            
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
