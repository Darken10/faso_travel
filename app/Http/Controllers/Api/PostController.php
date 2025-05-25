<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
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

    public function getAllLikes(Post $post): PostResource
    {
        return new LikeResource::collection(
            $post->likes()->with('user','post')->get()
        );
    }
}
