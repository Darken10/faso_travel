<?php

namespace App\Filament\Compagnie\Resources\CompanyUserResource\Pages;

use App\Filament\Compagnie\Resources\CompanyUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyUser extends EditRecord
{
    protected static string $resource = CompanyUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
