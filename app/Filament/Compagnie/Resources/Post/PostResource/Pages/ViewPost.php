<?php

namespace App\Filament\Compagnie\Resources\Post\PostResource\Pages;

use App\Filament\Compagnie\Resources\Post\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
