<?php

namespace App\Http\Requests\Api\V2\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\DTOs\User\UpdateProfileDTO;

class UpdateProfileFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone' => ['sometimes', 'string', 'max:20'],
            'password' => ['sometimes', 'string', 'min:8'],
        ];
    }

    public function toDTO(): UpdateProfileDTO
    {
        return UpdateProfileDTO::fromRequest($this->validated());
    }
}
