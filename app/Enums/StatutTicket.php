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

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Payer => 'info',
            self::EnAttente,self::Pause => 'warning',
            self::Valider => 'success',
            self::Annuler, self::Refuser,self::Suspendre,self::Bloquer => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Payer => 'heroicon-m-sparkles',
            self::EnAttente, self::Pause=> 'heroicon-m-arrow-path',
            self::Valider => 'heroicon-m-check-badge',
            self::Annuler, self::Refuser,self::Suspendre ,self::Bloquer=> 'heroicon-m-x-circle',
        };
    }
}
