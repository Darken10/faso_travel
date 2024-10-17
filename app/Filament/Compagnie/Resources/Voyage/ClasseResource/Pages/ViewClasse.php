<?php

namespace App\Filament\Compagnie\Resources\Voyage\ClasseResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\ClasseResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClasse extends ViewRecord
{
    protected static string $resource = ClasseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
