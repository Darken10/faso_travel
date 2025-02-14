<?php

namespace App\Filament\Compagnie\Resources\Ticket\TicketResource\Pages;

use App\Filament\Compagnie\Resources\Ticket\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Alignment;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    public function getFormActionsAlignment(): string|Alignment
    {
        return Alignment::End;
    }
}
