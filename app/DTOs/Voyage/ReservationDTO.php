<?php

namespace App\DTOs\Voyage;

use App\Enums\TripType;
use App\Enums\TypeTicket;

readonly class ReservationDTO
{
    public function __construct(
        public string $seats,
        public float $totalPrice,
        public bool $isForSelf,
        public TripType $tripType,
        public ?PassengerDTO $passenger = null,
        public bool $a_bagage = false,
        public ?array $bagages_data = null,
    ) {}

    public static function fromRequest(array $validated): self
    {
        $passenger = null;
        if (!($validated['isForSelf'] ?? true) && isset($validated['passenger'])) {
            $passenger = PassengerDTO::fromArray($validated['passenger']);
        }

        return new self(
            seats: $validated['seats'],
            totalPrice: (float) $validated['totalPrice'],
            isForSelf: (bool) $validated['isForSelf'],
            tripType: TripType::from($validated['tripType']),
            passenger: $passenger,
            a_bagage: (bool) ($validated['a_bagage'] ?? false),
            bagages_data: $validated['bagages_data'] ?? null,
        );
    }

    public function isRoundTrip(): bool
    {
        return $this->tripType === TripType::RoundTrip;
    }

    public function toTicketType(): TypeTicket
    {
        return $this->tripType->toTicketType();
    }
}
