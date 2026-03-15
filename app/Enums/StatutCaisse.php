<?php

namespace App\Enums;

enum StatutCaisse: string
{
    case Ouverte = 'ouverte';
    case Fermee = 'fermee';

    public function label(): string
    {
        return match ($this) {
            self::Ouverte => 'Ouverte',
            self::Fermee => 'Fermée',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Ouverte => 'success',
            self::Fermee => 'gray',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Ouverte => 'heroicon-o-lock-open',
            self::Fermee => 'heroicon-o-lock-closed',
        };
    }
}
