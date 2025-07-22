<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user' => [
                'name' => $this->user?->name,
                'compagnie' => $this->user?->compagnie?->name,
                'avatarUrl' => $this->user?->profile_photo_url,
            ],
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ] : null,
            'comments_count' => $this->comments->count(),
            'likes_count' => $this->likes->count(),
            'tags' => $this->tags ? $this->tags->pluck('name')->toArray() : [],
            'image' => $this->images_uri ? (url('/storage/' . ltrim($this->images_uri, '/'))) : null,
            'comments' => CommentResource::collection($this->comments),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
