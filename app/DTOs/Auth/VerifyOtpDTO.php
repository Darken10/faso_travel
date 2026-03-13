<?php

namespace App\DTOs\Auth;

readonly class VerifyOtpDTO
{
    public function __construct(
        public string $phone_or_email,
        public string $otp,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            phone_or_email: $validated['phone_or_email'],
            otp: $validated['otp'],
        );
    }
}
