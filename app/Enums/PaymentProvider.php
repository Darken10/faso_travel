<?php

namespace App\Enums;

enum PaymentProvider: string
{
    case ORANGE = 'orange';
    case MOOV = 'moov';
    case CORIS = 'coris';
    case WAVE = 'wave';
    case LIGDICASH = 'ligdicash';

    // Méthode pour obtenir le nom complet du provider
    public function getName(): string
    {
        return match ($this) {
            self::ORANGE => 'Orange Money',
            self::MOOV => 'Moov Money',
            self::CORIS => 'Coris Money',
            self::WAVE => 'Wave',
            self::LIGDICASH => 'LigdiCash',
        };
    }
}
