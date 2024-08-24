<?php

namespace App\Filament\Compagnie\Resources\Voyage\VoyageResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\VoyageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVoyages extends ListRecords
{
    protected static string $resource = VoyageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
