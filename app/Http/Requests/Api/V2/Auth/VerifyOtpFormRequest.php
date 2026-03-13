<?php

namespace App\Http\Requests\Api\V2\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Auth\VerifyOtpDTO;

class VerifyOtpFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_or_email' => ['required', 'string'],
            'otp' => ['required', 'string', 'size:6'],
        ];
    }

    public function toDTO(): VerifyOtpDTO
    {
        return VerifyOtpDTO::fromRequest($this->validated());
    }
}
