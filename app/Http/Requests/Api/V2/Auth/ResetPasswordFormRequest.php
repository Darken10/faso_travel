<?php

namespace App\Http\Requests\Api\V2\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Auth\ResetPasswordDTO;

class ResetPasswordFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function toDTO(): ResetPasswordDTO
    {
        return ResetPasswordDTO::fromRequest($this->validated());
    }
}
