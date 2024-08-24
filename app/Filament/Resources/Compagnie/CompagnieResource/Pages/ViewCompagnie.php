<?php

namespace App\Filament\Resources\Compagnie\CompagnieResource\Pages;

use App\Filament\Resources\Compagnie\CompagnieResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompagnie extends ViewRecord
{
    protected static string $resource = CompagnieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
