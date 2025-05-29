<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\LikeResource;
use App\Http\Resources\PostListResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserMiniResource;
use App\Http\Resources\UserUltraMiniRessource;
use App\Models\Post\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $posts = $this->postService->getAllPosts();
        return PostListResource::collection($posts);
    }

    public function show(int $id): PostResource
    {
        $post = $this->postService->getPost($id);
        return new PostResource($post);
    }

    public function likePost(Post $post)
    {
        if ($this->postService->isLikedByUser($post)) {
            return response()->json([
                'success' => false,
                'like_count' => $post->likes()->count(),
                'message' => 'Vous avez déjà aimé ce post'
            ], 409);
        }

        if ($this->postService->likePost($post)) {
            return response()->json([
                'success' => true,
                'like_count' => $post->likes()->count(),
                'message' => 'Post aimé avec succès'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Échec de l\'action'
        ], 500);
    }

    public function unlikePost(Post $post)
    {
        if (!$this->postService->isLikedByUser($post)) {
            return response()->json([
                'success' => false,
                'like_count' => $post->likes()->count(),
                'message' => 'Vous n\'avez pas encore aimé ce post'
            ], 409);
        }

        if ($this->postService->dislikePost($post)) {
            return response()->json([
                'success' => true,
                'like_count' => $post->likes()->count(),
                'message' => 'Like retiré avec succès'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Échec de l\'action'
        ], 500);
    }

    public function getAllLikes(Post $post): AnonymousResourceCollection
    {
        return LikeResource::collection(
            $this->postService->getAllLikes($post)
        );
    }

    public function getAllComments(Post $post): AnonymousResourceCollection
    {
        return LikeResource::collection(
            $this->postService->getAllComments($post)
        );
    }

    public function getPostLikes(Post $post): AnonymousResourceCollection
    {
        $users = $this->postService->getPostLikes($post);
        return UserMiniResource::collection($users);
    }

    public function getPostComments(Post $post): AnonymousResourceCollection
    {
        $comments = $this->postService->getPostComments($post);
        return CommentResource::collection($comments);
    }

    public function getPostsByUser(int $userId): AnonymousResourceCollection
    {
        $user = User::findOrFail($userId);
        $posts = $this->postService->getPostsByUser($user);
        return PostResource::collection($posts);
    }

    public function getUserPosts(): AnonymousResourceCollection
    {
        $user = Auth::user();
        $posts = $this->postService->getPostsByUser($user);
        return PostResource::collection($posts);
    }
    public function getUserLikedPosts(): AnonymousResourceCollection
    {
        $user = Auth::user();
        $posts = Post::whereHas('likes', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['user', 'comments.user', 'likes', 'tags'])->paginate(10);

        return PostResource::collection($posts);
    }

    public function getPostsByCompany(int $companyId): AnonymousResourceCollection
    {
        $company = User::findOrFail($companyId)->compagnie;
        $posts = $this->postService->getPostsByCompany($company);
        return PostResource::collection($posts);
    }

    public function getCompanyPosts(): \Illuminate\Http\JsonResponse|AnonymousResourceCollection
    {
        $user = Auth::user();
        if (!$user->compagnie) {
            return response()->json(['message' => 'User does not belong to a company.'], 404);
        }
        $posts = $this->postService->getPostsByCompany($user->compagnie);
        return PostResource::collection($posts);
    }

    public function addComment(Post $post)
    {
        $validatedData = request()->validate([
            'message' => 'required|string|max:1000'
        ]);

        $comment = $this->postService->addComment($post, $validatedData);

        return response()->json([
            'success' => true,
            'comment' => new CommentResource($comment),
            'message' => 'Commentaire ajouté avec succès'
        ], 201);
    }
}
