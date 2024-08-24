<?php

namespace App\Filament\Compagnie\Resources\Voyage\VoyageResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\VoyageResource;
use App\Models\Voyage\Trajet;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVoyage extends CreateRecord
{
    protected static string $resource = VoyageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $traget = Trajet::query()->where('depart_id', $data['ville_depart'])->where('arriver_id', $data['ville_arrive'])->first();
        if ($traget == null) {
            $traget = Trajet::create([
                'depart_id'=>$data['ville_depart'],
                'arriver_id'=>$data['ville_arrive'],
            ]);
        }
        $data['trajet_id'] = $traget->id;
        return $data;
    }
}
