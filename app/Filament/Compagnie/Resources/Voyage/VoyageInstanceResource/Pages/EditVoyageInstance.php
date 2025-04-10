<?php

namespace App\Filament\Compagnie\Resources\Voyage\VoyageInstanceResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\VoyageInstanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVoyageInstance extends EditRecord
{
    protected static string $resource = VoyageInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
