<?php

namespace App\Http\Requests\Api\V2\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilePictureFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'photo' => ['required', 'image', 'max:2048'],
        ];
    }
}
