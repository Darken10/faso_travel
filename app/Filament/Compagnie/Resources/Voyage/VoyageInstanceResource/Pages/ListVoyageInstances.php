<?php

namespace App\Filament\Compagnie\Resources\Voyage\VoyageInstanceResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\VoyageInstanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVoyageInstances extends ListRecords
{
    protected static string $resource = VoyageInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
