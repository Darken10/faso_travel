<?php

namespace App\Enums;

enum StatutPayement: string
{
    case EnAttente = 'En attente';
    case Annuler = 'Annuler';
    case complete = 'complete';


    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
