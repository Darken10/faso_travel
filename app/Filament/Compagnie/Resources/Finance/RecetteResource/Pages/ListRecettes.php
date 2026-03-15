<?php

namespace App\Filament\Compagnie\Resources\Finance\RecetteResource\Pages;

use App\Filament\Compagnie\Resources\Finance\RecetteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecettes extends ListRecords
{
    protected static string $resource = RecetteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nouvelle recette'),
        ];
    }
}
