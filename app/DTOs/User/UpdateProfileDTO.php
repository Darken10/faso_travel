<?php

namespace App\DTOs\User;

readonly class UpdateProfileDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $password = null,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            name: $validated['name'] ?? null,
            email: $validated['email'] ?? null,
            phone: $validated['phone'] ?? null,
            password: $validated['password'] ?? null,
        );
    }
}
