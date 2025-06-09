<?php

namespace App\Services\Voyage;

use App\Enums\JoursSemain;
use App\Helper\VoyagesInstanceHelpers;
use App\Models\Voyage\Voyage;
use App\Models\Voyage\VoyageInstance;
use Illuminate\Database\Eloquent\Builder;

class VoyageInstanceService
{
    public function __construct()
    {
    }

    public function createAll()
    {

        $joursAvenir = 30;
        $aujourdHui = now();
        for ($i=0; $i < $joursAvenir; $i++) {
            $dateVoyage = $aujourdHui->copy()->addDays($i);
            Voyage::all()->each(function (Voyage $voyage) use ($dateVoyage) {
                dump('debut');
                dump(VoyagesInstanceHelpers::isVoyageExisteInThisDate($dateVoyage,$voyage->days) ,$dateVoyage->format('l'));
                if (in_array(JoursSemain::ToutLesJours,$voyage->days) || VoyagesInstanceHelpers::isVoyageExisteInThisDate($dateVoyage,$voyage->days)){

                    $voyageInstance = VoyageInstance::firstOrCreate([
                        'voyage_id' => $voyage->id,
                        'date' => $dateVoyage,
                        'heure'=> $voyage->heure,
                        'nb_place'=>$voyage->nb_pace,
                        'care_id'=> $voyage->cares->last()->id ?? null,
                        'chauffer_id'=> null // TODO: id du chauffer qui doit conduire
                    ]);
                    echo "Voyage instance ".$voyageInstance->id." created";
                }
            });
        }

    }

    public function getVoyageInstanceWithBasicRelations(string $id)
    {
        return VoyageInstance::with([
            'voyage.trajet.depart',
            'voyage.trajet.arriver',
            'voyage.compagnie',
            'chauffer',
            'care'
        ])->findOrFail($id);
    }

    public function getVoyageInstanceWithFullDetails(string $id)
    {
        return VoyageInstance::with([
            'voyage.trajet.depart',
            'voyage.trajet.arriver',
            'voyage.compagnie',
            'voyage.classe',
            'voyage.conforts',
            'chauffer',
            'care',
            'tickets' => function($query) {
                $query->with(['user', 'autre_personne', 'payements']);
            }
        ])->findOrFail($id);
    }

    public function getAvailableVoyages(): Builder
    {
        return VoyageInstance::disponibles()
            ->with([
                'voyage.trajet.depart',
                'voyage.trajet.arriver',
                'voyage.compagnie',
                'voyage.classe'
            ]);
    }
}
