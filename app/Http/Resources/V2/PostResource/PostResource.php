<?php

namespace App\Http\Resources\V2\PostResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\V2\PostResource\CommentRessource;
use App\Http\Resources\V2\PostResource\PostAuthorRessource;

class PostResource extends JsonResource
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
            'summary' => $this->getSummary(),
            'content' => $this->content,
            'image' => $this->getImageUrl(),
            'category' => $this->category->name,
            'tags' => $this->tags->pluck('name')->toArray(),
            'publishedAt' => $this->publishedAt,
            'likes' => $this->likes->count(),
            'i_liked' => $this->likes->contains('user_id', auth()->id()),
            'author' => PostAuthorRessource::make($this->user),
            'comments' => CommentRessource::collection($this->comments),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

