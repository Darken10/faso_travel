<?php

namespace App\DTOs\Voyage;

readonly class SearchTripsDTO
{
    public function __construct(
        public ?string $departureCity = null,
        public ?string $arrivalCity = null,
        public ?string $date = null,
        public ?string $company = null,
        public ?int $passengers = null,
        public ?string $vehicleType = null,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            departureCity: $validated['departureCity'] ?? null,
            arrivalCity: $validated['arrivalCity'] ?? null,
            date: $validated['date'] ?? null,
            company: $validated['company'] ?? null,
            passengers: isset($validated['passengers']) ? (int) $validated['passengers'] : null,
            vehicleType: $validated['vehicleType'] ?? null,
        );
    }
}
