<?php

namespace App\Filament\Compagnie\Resources\Voyage\TrajetResource\Pages;

use App\Filament\Compagnie\Resources\Voyage\TrajetResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrajet extends EditRecord
{
    protected static string $resource = TrajetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
