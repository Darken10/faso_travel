<?php

namespace App\Enums;

enum CompanyRole: string
{
    case Admin = 'company_admin';
    case Agent = 'agent';
    case Bagagiste = 'bagagiste';
    case Comptabilite = 'comptabilite';
    case RH = 'rh';
    case Caisse = 'caisse';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Administrateur Compagnie',
            self::Agent => 'Agent',
            self::Bagagiste => 'Bagagiste',
            self::Comptabilite => 'Comptabilité',
            self::RH => 'Ressources Humaines',
            self::Caisse => 'Caisse / Guichet',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])->toArray();
    }
}
