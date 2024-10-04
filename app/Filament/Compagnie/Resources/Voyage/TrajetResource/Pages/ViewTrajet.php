<?php

namespace App\Filament\Compagnie\Resources\Voyage\TrajetResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\TrajetResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrajet extends ViewRecord
{
    protected static string $resource = TrajetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
