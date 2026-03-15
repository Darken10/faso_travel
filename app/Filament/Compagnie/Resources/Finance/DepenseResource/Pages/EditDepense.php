<?php

namespace App\Filament\Compagnie\Resources\Finance\DepenseResource\Pages;

use App\Filament\Compagnie\Resources\Finance\DepenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepense extends EditRecord
{
    protected static string $resource = DepenseResource::class;

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
