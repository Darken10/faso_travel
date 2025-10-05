<?php

namespace App\Http\Resources\ApiV2;

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
            'category' => $this->category->name,
            'image' => $this->image,
            'like_count' => $this->likes->count(),
            'comments_count' => $this->comments->count(),
            'tags' => $this->tags->pluck('name'),
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'photo' => $this->user->photo,
            ],
            'compagnie' => [
                'name' => $this->user->compagnie->name,
                'logo' => $this->user->compagnie->logo,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
