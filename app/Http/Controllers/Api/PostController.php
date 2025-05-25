<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\LikeResource;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use App\Models\User;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function __construct(private PostService $postService)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        $posts = $this->postService->getAllPosts();
        return PostResource::collection($posts);
    }

    public function show(int $id): PostResource
    {
        $post = $this->postService->getPost($id);
        return new PostResource($post);
    }

    public function LikePost(Post $post)
    {
        if ($this->postService->isLikedByUser($post)) {
            // Already liked
            return response()->json([
                'success' => false,
                'like_count'=> $post->likes()->count(),
                'message' => 'You have already liked this post.'
            ])->setStatusCode(409); // Conflict status code
        }
        if ($this->postService->likePost($post)) {
            return response()->json([
                'success' => true,
                'like_count'=> $post->likes()->count(),
                'message' => 'Post liked successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to like the post.'
        ])->setStatusCode(500); // Internal Server Error status code
    }


    public function disLikePost(Post $post)
    {
        if (!$this->postService->isLikedByUser($post)) {
            // Not liked yet
            return response()->json([
                'success' => false,
                'like_count'=> $post->likes()->count(),
                'message' => 'You have not liked this post yet.'
            ])->setStatusCode(409); // Conflict status code
        }

        if (!$this->postService->dislikePost($post)) {
            return response()->json([
                'success' => false,
                'like_count'=> $post->likes()->count(),
                'message' => 'Failed to dislike the post.'
            ])->setStatusCode(500); // Internal Server Error status code
        }

        return response()->json([
            'success' => true,
            'like_count'=> $post->likes()->count(),
            'message' => 'Post disliked successfully.'
        ]);

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
        return LikeResource::collection(
            $this->postService->getPostLikes($post)
        );
    }

    public function getComments(Post $post): AnonymousResourceCollection
    {
        return CommentResource::collection(
            $this->postService->getPostComments($post)
        );
    }

    public function getPostsByUser(int $userId): AnonymousResourceCollection
    {
        $user = User::findOrFail($userId);
        $posts = $this->postService->getPostsByUser($user);
        return PostResource::collection($posts);
    }

    public function getUserPosts(): AnonymousResourceCollection
    {
        $user = auth()->user();
        $posts = $this->postService->getPostsByUser($user);
        return PostResource::collection($posts);
    }
    public function getUserLikedPosts(): AnonymousResourceCollection
    {
        $user = auth()->user();
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
        $user = auth()->user();
        if (!$user->compagnie) {
            return response()->json(['message' => 'User does not belong to a company.'], 404);
        }
        $posts = $this->postService->getPostsByCompany($user->compagnie);
        return PostResource::collection($posts);
    }

    public function addComment(Post $post)
    {
        $data = request()->validate([
            'message' => 'required|string|max:255',
        ]);


        return new CommentResource(
            $this->postService->addComment($post, $data)
        );

    }
}
