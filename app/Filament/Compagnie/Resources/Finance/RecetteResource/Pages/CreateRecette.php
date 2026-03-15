<?php

namespace App\Filament\Compagnie\Resources\Finance\RecetteResource\Pages;

use App\Filament\Compagnie\Resources\Finance\RecetteResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateRecette extends CreateRecord
{
    protected static string $resource = RecetteResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['compagnie_id'] = Auth::user()->compagnie_id;
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
