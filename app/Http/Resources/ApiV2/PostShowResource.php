<?php

namespace App\Http\Resources\ApiV2;

use Illuminate\Http\Request;
use App\Http\Resources\LikeResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\UserMiniResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostShowResource extends JsonResource
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
            'category' => $this->category->name,
            'image' => $this->image,
            'like_count' => $this->likes->count(),
            'comments_count' => $this->comments->count(),
            'tags' => $this->tags->pluck('name'),
            'user' => UserMiniResource::make($this->user),
            'compagnie' => CompagnieMiniResource::make($this->user->compagnie),
            'comments' => CommentResource::collection($this->comments),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
