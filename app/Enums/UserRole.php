<?php

namespace App\Enums;

enum UserRole: string
{
    case Root = 'Super User' ;
    case Admin = 'Admin' ;
    case User = 'User' ;
    case CompagnieBosse = 'Companie Bosse';

    public static function values() : array {
        return array_column(self::cases(), 'value');
    }
}
