<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Get all articles
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $filters = [
                'category_id' => $request->get('category_id'),
                'search' => $request->get('search'),
            ];

            $articles = $this->articleService->getAllArticles($perPage, $filters);

            return response()->json([
                'status' => 'success',
                'message' => 'Articles récupérés avec succès',
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
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $article = $this->articleService->getArticleById($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Article récupéré avec succès',
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
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:post_categories,id',
                'image' => 'nullable|image|max:2048',
            ]);

            $article = $this->articleService->createArticle(
                $validated,
                $request->hasFile('image') ? $request->file('image') : null
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Article créé avec succès',
                'data' => $article
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update an article
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'content' => 'sometimes|string',
                'category_id' => 'sometimes|exists:post_categories,id',
                'image' => 'nullable|image|max:2048',
            ]);

            $article = $this->articleService->updateArticle(
                $id,
                $validated,
                $request->hasFile('image') ? $request->file('image') : null
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Article mis à jour avec succès',
                'data' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete an article
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $result = $this->articleService->deleteArticle($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Article supprimé avec succès',
                'data' => ['deleted' => $result]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Toggle like on an article
     *
     * @param int $id
     * @return JsonResponse
     */
    public function toggleLike(int $id): JsonResponse
    {
        try {
            $result = $this->articleService->toggleLike($id);

            return response()->json([
                'status' => 'success',
                'message' => $result['action'] === 'liked' ? 'Article aimé' : 'Article plus aimé',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Add comment to an article
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function addComment(Request $request, int $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'content' => 'required|string',
            ]);

            $comment = $this->articleService->addComment($id, $validated['content']);

            return response()->json([
                'status' => 'success',
                'message' => 'Commentaire ajouté avec succès',
                'data' => $comment
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete a comment
     *
     * @param int $commentId
     * @return JsonResponse
     */
    public function deleteComment(int $commentId): JsonResponse
    {
        try {
            $result = $this->articleService->deleteComment($commentId);

            return response()->json([
                'status' => 'success',
                'message' => 'Commentaire supprimé avec succès',
                'data' => ['deleted' => $result]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get all article categories
     *
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        try {
            $categories = $this->articleService->getCategories();

            return response()->json([
                'status' => 'success',
                'message' => 'Catégories récupérées avec succès',
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
