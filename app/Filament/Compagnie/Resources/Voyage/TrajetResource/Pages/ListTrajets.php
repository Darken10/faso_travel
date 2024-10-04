<?php

namespace App\Filament\Compagnie\Resources\Voyage\TrajetResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\TrajetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrajets extends ListRecords
{
    protected static string $resource = TrajetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
