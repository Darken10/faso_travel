<?php

namespace App\Filament\Compagnie\Resources\Post\PostResource\Pages;

use App\Filament\Compagnie\Resources\Post\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
