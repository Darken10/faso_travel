<?php

namespace App\Enums;

enum StatutCare: string
{

    case EnPanne = 'En Panne';
    case Occuper = 'Occuper';
    case Disponible = 'Disponible';


    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valuesString():array
    {
        return [
            'En Panne' => 'En Panne',
            'Occuper' => 'Occuper',
            'Disponible' => 'Disponible',
        ];
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Occuper => 'info',
            self::EnPanne,  => 'danger',
            self::Disponible => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Occuper=> 'heroicon-m-arrow-path',
            self::Disponible => 'heroicon-m-check-badge',
            self::EnPanne=> 'heroicon-m-x-circle',
        };
    }
}

