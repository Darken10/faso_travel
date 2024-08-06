<?php

namespace App\Filament\Resources\Ville\VilleResource\Pages;

use App\Filament\Resources\Ville\VilleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVille extends EditRecord
{
    protected static string $resource = VilleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
