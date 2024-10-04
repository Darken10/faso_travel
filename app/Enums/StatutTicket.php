<?php

namespace App\Enums;

enum StatutTicket: string
{
    case Payer = 'Payer';
    case EnAttente = 'En attente';
    case Annuler = 'Annuler';
    case Refuser = 'Refuser';
    case Valider = 'Valider';
    case Pause = 'Pause';
    case Bloquer = 'Bloquer';
    case Suspendre = 'Suspendre';


    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
