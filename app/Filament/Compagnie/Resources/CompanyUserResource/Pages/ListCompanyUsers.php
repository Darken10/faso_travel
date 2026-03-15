<?php

namespace App\Filament\Compagnie\Resources\CompanyUserResource\Pages;

use App\Filament\Compagnie\Resources\CompanyUserResource;
use Filament\Resources\Pages\ListRecords;

class ListCompanyUsers extends ListRecords
{
    protected static string $resource = CompanyUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
