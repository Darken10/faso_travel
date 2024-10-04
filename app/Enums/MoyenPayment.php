<?php

namespace App\Enums;

enum MoyenPayment: string
{
    case OrangeMoney = 'Orange Money';
    case MoovMoney = 'Moov Money';
    case LigdiCash = 'LigdiCash';
    case CartVisa = 'Cart Visa';


    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
