<?php

namespace App\Enums;

enum JoursSemain: string
{
    case Lundi = 'Lundi';
    case Mardi = 'Mardi';
    case Mercredi = 'Mercredi';
    case Jeudi = 'Jeudi';
    case Vendredi = 'Vendredi';
    case Samedi = 'Samedi';
    case Dimanche = 'Dimanche';
    case ToutLesJours = 'Tout Les Jours';






    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
