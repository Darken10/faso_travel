<?php

namespace App\Filament\Resources\CompagnieSettingResource\Pages;

use App\Filament\Resources\CompagnieSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompagnieSetting extends EditRecord
{
    protected static string $resource = CompagnieSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
