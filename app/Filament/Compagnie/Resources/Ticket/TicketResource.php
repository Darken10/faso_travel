<?php

namespace App\Filament\Compagnie\Resources\Ticket;

use App\Enums\StatutTicket;
use App\Events\Admin\TicketValiderEvent;
use App\Events\Ticket\TicketBlockerEvent;
use App\Filament\Compagnie\Resources\Ticket\TicketResource\Pages;
use App\Filament\Compagnie\Resources\Ticket\TicketResource\RelationManagers;
use App\Filament\Compagnie\Widgets\StatsCompagnieOverview;
use App\Helper\TicketValidation;
use App\Models\Ticket\Ticket;
use App\Notifications\Ticket\ValiderTicketDeUserNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voyage.trajet.depart.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('voyage.trajet.arriver.name')
                    ->label('Destination')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date('Y/m/d')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('statut')
                    ->badge()
                    ->color(fn(Ticket $ticket)=> $ticket->statut->getColor())
                    ->icon(fn(Ticket $ticket)=> $ticket->statut->getIcon())
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                'voyage_id',
            ])
            ->defaultGroup('voyage_id')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Information du Ticket')
                ->schema([
                    TextEntry::make('numero_ticket')->label('Numero du Ticket'),
                    TextEntry::make('numero_chaise')
                        ->label('Numero du Chaise')
                    ->prefix('Chaise n° '),
                    TextEntry::make('statut')->label('Statut du Ticket')
                        ->badge()
                        ->color(fn(Ticket $ticket)=> $ticket->statut->getColor())
                        ->icon(fn(Ticket $ticket)=> $ticket->statut->getIcon()),
                    TextEntry::make('type')->label('Type de Ticket'),
                ])->columns(2)
                ->headerActions([
                    Action::make('Valider')
                        ->hidden(function (Ticket $ticket) {
                            return !$ticket->canValider();
                        })
                        ->icon('heroicon-m-star')
                        ->requiresConfirmation()
                        ->action(function (Ticket $ticket) {
                            \DB::transaction(function () use ($ticket) {
                                if (TicketValidation::valider($ticket)) {
                                    TicketValiderEvent::dispatch($ticket);
                                    $ticket->user->notify(new ValiderTicketDeUserNotification($ticket));
                                    if ($ticket->statut === StatutTicket::Valider){
                                        Notification::make()
                                            ->title('Le Ticket a ete Bien Valider')
                                            ->success()
                                            ->send();
                                    }
                                }
                            });
                        }),

                    Action::make('Bloque')
                        ->icon('heroicon-m-x-mark')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->hidden(function (Ticket $ticket) {
                            return $ticket->statut=== StatutTicket::Valider || $ticket->statut=== StatutTicket::Bloquer || $ticket->statut=== StatutTicket::Refuser;
                        })
                        ->action(function (Ticket $ticket) {
                            \DB::transaction(function () use ($ticket) {
                                if (TicketValidation::bloque($ticket)) {
                                    $ticket->user->notify(new ValiderTicketDeUserNotification($ticket));
                                    if ($ticket->statut === StatutTicket::Bloquer){
                                        Notification::make()
                                            ->title('Le Ticket a ete bien ete bloquer')
                                            ->success()
                                            ->send();
                                    }
                                }
                            });
                        }),
                    Action::make('Pause')
                        ->icon('heroicon-m-pause')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->hidden(function (Ticket $ticket) {
                            return $ticket->statut!== StatutTicket::Payer ;
                        })
                        ->action(function (Ticket $ticket) {
                            \DB::transaction(function () use ($ticket) {
                                if (TicketValidation::pause($ticket)) {
                                    $ticket->user->notify(new ValiderTicketDeUserNotification($ticket));
                                    if ($ticket->statut === StatutTicket::Pause){
                                        Notification::make()
                                            ->title('Le Ticket a ete bien ete mis en pause')
                                            ->success()
                                            ->send();
                                    }
                                }
                            });
                        }),
                    Action::make('Active')
                        ->icon('heroicon-m-play-pause')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->hidden(function (Ticket $ticket) {
                            return $ticket->statut!== StatutTicket::Bloquer ;
                        })
                        ->action(function (Ticket $ticket) {
                            \DB::transaction(function () use ($ticket) {
                                if (TicketValidation::active($ticket)) {
                                    $ticket->user->notify(new ValiderTicketDeUserNotification($ticket));
                                    if ($ticket->statut === StatutTicket::Pause){
                                        Notification::make()
                                            ->title('Le Ticket a ete bien ete mis en pause')
                                            ->success()
                                            ->send();
                                    }
                                }
                            });
                        }),
                ]),

            Section::make('Information du Voyage ')
                ->schema([
                    TextEntry::make('voyage.compagnie.name')->label('Compagnie'),
                    TextEntry::make('voyage.classe.name')->label('Classe '),
                    TextEntry::make('voyage.trajet.depart.name')->label('Ville Depart'),
                    TextEntry::make('voyage.trajet.arriver.name')->label('Ville Arriver'),
                    TextEntry::make('voyage.gareDepart.name')->label('Gare Depart'),
                    TextEntry::make('voyage.gareArrive.name')->label('Gare Arriver'),
                    TextEntry::make('date')->label('Date')
                    ->date('D d M Y'),
                    TextEntry::make('voyage.heure')->label('Heure ')
                    ->dateTime('H\h i '),
                    TextEntry::make('voyage.prix')->label('Prix de Ticket')->suffix(" XOF"),
                ])->columns(2),
            Section::make('Information de l\'utilisateur ')
                ->schema([
                    TextEntry::make('user.first_name')->label('Nom'),
                    TextEntry::make('user.last_name')->label('Prenom '),
                    TextEntry::make('user.email')->label('email'),
                    TextEntry::make('user.numero')->label('Numero'),
                    ImageEntry::make('user.profile_photo_url')->label('Profile')->circular(),

                ])->columns(2),

        ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'validate' => Pages\ValidateTicket::route('/validate'),
        ];
    }


}
