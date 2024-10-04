<?php

namespace App\Filament\Resources\Ville\PaysResource\Pages;

use App\Filament\Resources\Ville\PaysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPays extends EditRecord
{
    protected static string $resource = PaysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
