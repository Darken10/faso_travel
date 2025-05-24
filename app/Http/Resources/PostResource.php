<?php

namespace App\Http\Resources;

use App\resources\MiniUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user,
            'comments' => CommentResource::collection($this->comments),
            'likes_count' => $this->likes()->count(),
            'likes' => LikeResource::collection($this->likes),
            'tags' => TagResource::collection($this->tags),
            'images_uri' => $this->images_uri,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
