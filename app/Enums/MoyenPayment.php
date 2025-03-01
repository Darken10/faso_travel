<?php

namespace App\Enums;

enum MoyenPayment: string
{
    case ORRANGE_MONEY = 'Orange Money';
    case MOOV_MONEY = 'Moov Money';
    case LIGDICASH = 'LigdiCash';
    case CARTE_VISA = 'Cart Visa';
    const CORIS_MONEY = "Coris Money";
    const WAVE = "Wave";

    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
