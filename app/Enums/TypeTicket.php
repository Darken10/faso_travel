<?php
namespace App\Enums;

enum TypeTicket : string {
    case AllerRetour = 'aller-retour' ;
    case AllerSimple = 'aller-simple';
    case RetourSimple = 'retour-simple';

    public static function values() : array {
        return array_column(self::cases(), 'value');
    }

}
