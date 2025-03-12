<?php

namespace App\Helper;

use App\Enums\JoursSemain;
use Carbon\Carbon;

class VoyagesInstanceHelpers
{
    public static function isVoyageExisteInThisDate(Carbon $date,array $jours):bool
    {

        $daysMap = [
            "Dimanche" => 0, "Lundi" => 1, "Mardi" => 2, "Mercredi" => 3,
            "Jeudi" => 4, "Vendredi" => 5, "Samedi" => 6
        ];

        $currentDayName = $date->format('l'); // Récupère le nom du jour en anglais (ex: "Monday")
        $currentDayFrench = array_search($date->dayOfWeek, $daysMap, true); // Convertit en nom français

        // Vérifie si le jour actuel est dans la liste des jours de l'Enum
        return in_array(JoursSemain::from($currentDayFrench)->value, $jours);
    }
}
