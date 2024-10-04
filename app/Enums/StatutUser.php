<?php

namespace App\Enums;

enum StatutUser: string
{
    case Active = 'Active';
    case EnAttente = 'En attente';
    case Bloquer = 'Bloquer';
    case Suspendre = 'Suspendre';


    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
