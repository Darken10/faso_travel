<?php

namespace App\Filament\Compagnie\Resources\Compagnie\CareResource\Pages;

use App\Filament\Compagnie\Resources\Compagnie\CareResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCares extends ListRecords
{
    protected static string $resource = CareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
