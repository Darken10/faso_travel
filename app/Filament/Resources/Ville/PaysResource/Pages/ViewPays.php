<?php

namespace App\Filament\Resources\Ville\PaysResource\Pages;

use App\Filament\Resources\Ville\PaysResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPays extends ViewRecord
{
    protected static string $resource = PaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
