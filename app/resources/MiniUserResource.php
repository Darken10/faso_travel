<?php

namespace App\resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class MiniUserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->name,
            'sexe' => $this->sexe,
            'email' => $this->email,
            'numero' => $this->numero,
            'numero_identifiant' => $this->numero_identifiant,
            'profile_photo_path' => $this->profile_photo_path,
            'profile_photo_url' => $this->profile_photo_url,
        ];
    }
}
