<?php

namespace App\Filament\Compagnie\Resources\Ticket\TicketResource\Pages;

use App\Filament\Compagnie\Resources\Post\PostResource;
use App\Filament\Compagnie\Resources\Ticket\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
