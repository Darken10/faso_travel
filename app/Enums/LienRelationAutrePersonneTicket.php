<?php

namespace App\Enums;

enum LienRelationAutrePersonneTicket: string
{
    case Enfant = 'Enfant';
    case Frere = 'Frere/Soeur';
    case Cousin = 'Cousin(e)';
    case Ami = 'Ami(e)';
    case Parent = 'parents (Pere/Mere)';
    case GrandParent = 'Grand Parent (Grand Pere/Grand Mere)';
    case copin = 'Copin/Copine';
    case Autre = 'Autre';







    public static function values():array
    {
        return array_column(self::cases(), 'value');
    }
}
