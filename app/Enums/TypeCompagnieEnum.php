<?php

namespace App\Enums;

enum TypeCompagnieEnum : string
{

    case CAR = 'Car';
    case TRAIN = 'Train';
    case AVION = 'Avion';
    case BATEAU = 'Bateau';
    case BUS = 'Bus';
    case AUTRE = 'Autre';

    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
