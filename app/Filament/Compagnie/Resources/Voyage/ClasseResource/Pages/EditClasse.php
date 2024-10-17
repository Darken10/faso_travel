<?php

namespace App\Filament\Compagnie\Resources\Voyage\ClasseResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\ClasseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClasse extends EditRecord
{
    protected static string $resource = ClasseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
