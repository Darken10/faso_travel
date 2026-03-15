<?php

namespace App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource\Pages;

use App\Filament\Compagnie\Resources\Finance\CategorieDepenseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCategorieDepense extends CreateRecord
{
    protected static string $resource = CategorieDepenseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['compagnie_id'] = Auth::user()->compagnie_id;

        return $data;
    }
}
