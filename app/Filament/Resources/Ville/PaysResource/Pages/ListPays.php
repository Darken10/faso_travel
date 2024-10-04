<?php

namespace App\Filament\Resources\Ville\PaysResource\Pages;

use App\Filament\Resources\Ville\PaysResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPays extends ListRecords
{
    protected static string $resource = PaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
