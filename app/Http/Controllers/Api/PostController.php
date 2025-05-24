<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
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
}
