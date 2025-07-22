<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\V2\ArticleService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\V2\PostResource\PostResource;

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
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 15);
            $filters = [
                'category_id' => $request->get('category_id'),
                'search' => $request->get('search'),
            ];
            $articles = $this->articleService->getAllArticles($perPage, $filters);
            // Succès : retourne la collection paginée via ArticleCollection
            return $articles;
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Get article by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $article = $this->articleService->getArticleById($id);
            // Succès : retourne directement la ressource
            return new PostResource($article);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
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
     * Get all comments for an article
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getAllComments(int $id): JsonResponse
    {
        try {
            $article = $this->articleService->getArticleById($id);
            
            return response()->json(
                $article->comments()
                    ->with('user:id,name,profile_photo_path')
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($comment) {
                        return [
                            'id' => $comment->id,
                            'content' => $comment->message,
                            'created_at' => $comment->created_at->format('Y-m-d H:i:s'),
                            'author' => [
                                'id' => $comment->user->id,
                                'name' => $comment->user->name,
                                'avatar' => $comment->user->profile_photo_path
                            ]
                        ];
                    })
            );
        } catch (\Exception $e) {
            return response()->json([], 404);
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
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ], [
            'content.required' => 'Le champ contenu est obligatoire.',
            'content.string' => 'Le champ contenu doit être une chaîne de caractères.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Erreur de validation.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $comment = $this->articleService->addComment($id, $request->content);

        return response()->json(CommentResource::make($comment), 201);
    }

    /**
     * Delete a comment
     *
     * @param int $commentId
     * @return JsonResponse
     */
    public function deleteComment(int $commentId): JsonResponse
    {
        Log::info("Attempting to delete comment with ID: $commentId");
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

            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
