<?php

namespace App\Filament\Resources\Ville\VilleResource\Pages;

use App\Filament\Resources\Ville\VilleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVilles extends ListRecords
{
    protected static string $resource = VilleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
