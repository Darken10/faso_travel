<?php

namespace App\Http\Resources;

use App\resources\MiniUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->message,
            'user' => new MiniUserResource($this->user),
            'created_at' => $this->created_at,
        ];
    }
}
