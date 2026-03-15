<?php

namespace App\Filament\Compagnie\Resources\CompanyUserResource\Pages;

use App\Filament\Compagnie\Resources\CompanyUserResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyUser extends ViewRecord
{
    protected static string $resource = CompanyUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
