<?php

namespace App\Helper;

class TicketHelpers{

    public static function generateTicketNumber():string{
        $number = rand(0,999999);
        return "TK $number";
    }

}