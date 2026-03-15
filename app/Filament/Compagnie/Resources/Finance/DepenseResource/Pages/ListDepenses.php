<?php

namespace App\Filament\Compagnie\Resources\Finance\DepenseResource\Pages;

use App\Filament\Compagnie\Resources\Finance\DepenseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDepenses extends ListRecords
{
    protected static string $resource = DepenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nouvelle dépense'),
        ];
    }
}
