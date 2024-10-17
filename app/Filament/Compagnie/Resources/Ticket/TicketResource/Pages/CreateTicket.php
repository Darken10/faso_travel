<?php

namespace App\Filament\Compagnie\Resources\Ticket\TicketResource\Pages;

use App\Filament\Compagnie\Resources\Ticket\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
