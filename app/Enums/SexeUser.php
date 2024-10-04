<?php

namespace App\Enums;

enum SexeUser: string
{
    case Homme = 'Homme' ;
    case Femme = 'Femme' ;
    case Autre = 'Autre' ;



    public static function values() : array {
        return array_column(self::cases(), 'value');
    }
}
