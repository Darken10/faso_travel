<?php

namespace App\Filament\Compagnie\Resources\Compagnie\CompagnieResource\Pages;

use App\Filament\Compagnie\Resources\Compagnie\CompagnieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompagnie extends EditRecord
{
    protected static string $resource = CompagnieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
