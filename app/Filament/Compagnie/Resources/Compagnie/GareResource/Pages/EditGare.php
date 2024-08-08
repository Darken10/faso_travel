<?php

namespace App\Filament\Compagnie\Resources\Compagnie\GareResource\Pages;

use App\Filament\Compagnie\Resources\Compagnie\GareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGare extends EditRecord
{
    protected static string $resource = GareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
