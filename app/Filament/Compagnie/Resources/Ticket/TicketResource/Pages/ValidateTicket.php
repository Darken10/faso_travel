<?php

namespace App\Filament\Compagnie\Resources\Ticket\TicketResource\Pages;

use App\Filament\Compagnie\Resources\Ticket\TicketResource;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use Filament\Support\Enums\Alignment;

class ValidateTicket extends Page implements HasForms
{
    use  InteractsWithForms;

    protected static string $resource = TicketResource::class;

    protected static string $view = 'filament.compagnie.resources.ticket.ticket-resource.pages.validate-ticket';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Section::make("Valider un Ticket")
                ->description("Valider un Ticket a partir du numero de tel et le Code du ticket")
                ->schema([
                    Forms\Components\TextInput::make('numero')
                        ->required()
                        ->type('tel'),
                    Forms\Components\TextInput::make('code')
                        ->required()
                        ->numeric(),
                ])
        ];
    }

    public function submitForm(array $data): void
    {
        \Log::info("Donne soumise : ",$data);

    }

    public function test(): void
    {
        \Log::info("Test soumise : ");

    }

    public function getFormActionsAlignment(): string|Alignment
    {
        return Alignment::End;
    }

    public function getActions(): array
    {
        return [
            Action::make('submit')->label('soumettre')->action('test'),
        ];
    }


    protected function getFormActions(): array
    {
        return [
            Action::make('submit')->label('soumettre')->action('submitForm'),
        ];
    }



}
