<?php

namespace App\Filament\Resources\Compagnie\CompagnieResource\Pages;

use App\Filament\Resources\Compagnie\CompagnieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompagnies extends ListRecords
{
    protected static string $resource = CompagnieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
