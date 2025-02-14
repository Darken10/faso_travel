<?php

namespace App\Filament\Compagnie\Resources\Compagnie\CareResource\Pages;

use App\Filament\Compagnie\Resources\Compagnie\CareResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCare extends EditRecord
{
    protected static string $resource = CareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
