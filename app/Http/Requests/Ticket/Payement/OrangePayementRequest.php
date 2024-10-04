<?php

namespace App\Http\Requests\Ticket\Payement;

use Illuminate\Foundation\Http\FormRequest;

class OrangePayementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero'=>['required','numeric','digits_between:8,12'],
            'otp'=>['required','numeric','digits:6']
        ];
    }
}
