<?php

namespace App\Filament\Resources\Ville\VilleResource\Pages;

use App\Filament\Resources\Ville\VilleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVille extends ViewRecord
{
    protected static string $resource = VilleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
