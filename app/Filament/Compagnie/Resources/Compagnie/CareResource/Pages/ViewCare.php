<?php

namespace App\Filament\Compagnie\Resources\Compagnie\CareResource\Pages;

use App\Filament\Compagnie\Resources\Compagnie\CareResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCare extends ViewRecord
{
    protected static string $resource = CareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
