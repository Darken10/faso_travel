<?php

namespace App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource\Pages;

use App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategorieDepense extends EditRecord
{
    protected static string $resource = CategorieDepenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
