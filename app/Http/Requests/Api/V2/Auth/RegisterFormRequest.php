<?php

namespace App\Http\Requests\Api\V2\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Auth\RegisterDTO;

class RegisterFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'sexe' => ['nullable', 'string'],
            'numero' => ['nullable', 'integer'],
            'numero_identifiant' => ['nullable', 'string', 'max:10'],
            'role' => ['nullable', 'string'],
            'compagnie_id' => ['nullable', 'exists:compagnies,id'],
        ];
    }

    public function toDTO(): RegisterDTO
    {
        return RegisterDTO::fromRequest($this->validated());
    }
}
