<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
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
            'comments_count' => $this->comments()->count(),
            'likes_count' => $this->likes()->count(),
            'tags' => $this->tags->pluck('name')->toArray(),
            'image' => $this->getImageUrl(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
