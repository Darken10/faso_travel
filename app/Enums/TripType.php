<?php

namespace App\Enums;

enum TripType: string
{
    case OneWay = 'one-way';
    case RoundTrip = 'round-trip';

    public function toTicketType(): TypeTicket
    {
        return match ($this) {
            self::OneWay => TypeTicket::AllerSimple,
            self::RoundTrip => TypeTicket::AllerRetour,
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
