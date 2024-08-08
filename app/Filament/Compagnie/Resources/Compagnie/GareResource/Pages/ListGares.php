<?php

namespace App\Filament\Compagnie\Resources\Compagnie\GareResource\Pages;

use App\Filament\Compagnie\Resources\Compagnie\GareResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGares extends ListRecords
{
    protected static string $resource = GareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
