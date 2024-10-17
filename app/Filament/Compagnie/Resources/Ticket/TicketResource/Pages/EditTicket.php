<?php

namespace App\Filament\Compagnie\Resources\Ticket\TicketResource\Pages;

use App\Filament\Compagnie\Resources\Ticket\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTicket extends EditRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
