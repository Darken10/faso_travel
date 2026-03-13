<?php

namespace App\Http\Requests\Api\V2\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SendOtpFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_or_email' => ['required', 'string'],
        ];
    }
}
