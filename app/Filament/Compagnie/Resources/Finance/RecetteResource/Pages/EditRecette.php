<?php

namespace App\Filament\Compagnie\Resources\Finance\RecetteResource\Pages;

use App\Filament\Compagnie\Resources\Finance\RecetteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecette extends EditRecord
{
    protected static string $resource = RecetteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
