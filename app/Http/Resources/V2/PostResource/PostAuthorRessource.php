<?php

namespace App\Http\Resources\V2\PostResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostAuthorRessource extends JsonResource
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
            'name' => $this->name,
            'avatar' => $this->avatar,
        ];
    }
}
