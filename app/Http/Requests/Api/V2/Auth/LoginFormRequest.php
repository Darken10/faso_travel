<?php

namespace App\Http\Requests\Api\V2\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Auth\LoginDTO;

class LoginFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function toDTO(): LoginDTO
    {
        return LoginDTO::fromRequest($this->validated());
    }
}
