<?php

namespace App\Http\Requests\Api\V2\Article;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le champ contenu est obligatoire.',
            'content.string' => 'Le champ contenu doit être une chaîne de caractères.',
        ];
    }
}
