<?php

namespace App\Filament\Compagnie\Resources\Finance\DepenseResource\Pages;

use App\Filament\Compagnie\Resources\Finance\DepenseResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateDepense extends CreateRecord
{
    protected static string $resource = DepenseResource::class;

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
