<?php

namespace App\Enums;

enum StatutPayement: string
{
    case EnAttente = 'En attente';
    case Annuler = 'Annuler';
    case Complete = 'complete';


    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::EnAttente => 'info',
            self::Annuler,  => 'danger',
            self::Complete => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::EnAttente=> 'heroicon-m-arrow-path',
            self::Complete => 'heroicon-m-check-badge',
            self::Annuler=> 'heroicon-m-x-circle',
        };
    }
}
