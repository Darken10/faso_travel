<?php

namespace App\Http\Resources\ApiV2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompagnieMiniResource extends JsonResource
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
            'logo' => $this->logo,
            'statut' => $this->statut->name,
        ];
    }
}
