<?php

namespace App\Filament\Compagnie\Resources\Voyage\VoyageResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\VoyageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoyage extends EditRecord
{
    protected static string $resource = VoyageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
