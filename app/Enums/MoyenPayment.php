<?php

namespace App\Enums;

enum MoyenPayment: string
{
    case ORANGE_MONEY = 'Orange Money';
    case MOOV_MONEY = 'Moov Money';
    case LIGDICASH = 'LigdiCash';
    case CARTE_VISA = 'Carte Visa';
    case CORIS_MONEY = 'Coris Money';
    case WAVE = 'Wave';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::ORANGE_MONEY => 'orange-money',
            self::MOOV_MONEY => 'moov-money',
            self::LIGDICASH => 'ligdicash',
            self::CARTE_VISA => 'visa',
            self::CORIS_MONEY => 'coris-money',
            self::WAVE => 'wave',
        };
    }
}
