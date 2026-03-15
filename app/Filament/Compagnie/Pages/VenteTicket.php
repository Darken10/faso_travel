<?php

namespace App\Filament\Compagnie\Pages;

use App\Enums\MoyenPayment;
use App\Enums\SexeUser;
use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use App\Events\PayementEffectuerEvent;
use App\Helper\TicketHelpers;
use App\Models\Finance\Caisse;
use App\Models\Ticket\AutrePersonne;
use App\Models\Ticket\Payement;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\VoyageInstance;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class VenteTicket extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Guichet';
    protected static ?string $title = 'Vente de Ticket';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.compagnie.pages.vente-ticket';

    public ?array $data = [];
    public ?int $ticketVenduId = null;
    public float $prix = 0;
    public float $monnaie = 0;

    public function getCaisseOuverte(): ?Caisse
    {
        return Caisse::sessionOuverte();
    }

    public function mount(): void
    {
        $this->form->fill([
            'type_ticket' => TypeTicket::AllerSimple->value,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Voyage')
                        ->icon('heroicon-o-map')
                        ->description('Choisir le voyage')
                        ->schema([
                            Select::make('voyage_instance_id')
                                ->label('Voyage disponible')
                                ->options(function () {
                                    $compagnieId = Auth::user()->compagnie_id;

                                    return VoyageInstance::query()
                                        ->whereHas('voyage', fn ($q) => $q->withoutGlobalScopes()->where('compagnie_id', $compagnieId))
                                        ->avenir()
                                        ->get()
                                        ->filter(fn ($i) => count($i->chaiseDispo()) > 0)
                                        ->mapWithKeys(function ($instance) {
                                            $depart = $instance->villeDepart()?->name ?? '?';
                                            $arrivee = $instance->villeArrive()?->name ?? '?';
                                            $prix = number_format($instance->getPrix(TypeTicket::AllerSimple), 0, ',', ' ');
                                            $places = count($instance->chaiseDispo());

                                            $label = "{$depart} → {$arrivee}"
                                                . ' | ' . $instance->date->format('d/m/Y')
                                                . ' ' . $instance->heure->format('H\hi')
                                                . " | {$prix} F CFA"
                                                . " ({$places} places)";

                                            return [$instance->id => $label];
                                        });
                                })
                                ->searchable()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, $get) {
                                    $this->computePrix($state, $get('type_ticket'));
                                }),

                            Radio::make('type_ticket')
                                ->label('Type de ticket')
                                ->options([
                                    TypeTicket::AllerSimple->value => 'Aller Simple',
                                    TypeTicket::AllerRetour->value => 'Aller Retour',
                                ])
                                ->default(TypeTicket::AllerSimple->value)
                                ->required()
                                ->inline()
                                ->live()
                                ->afterStateUpdated(function ($state, $get) {
                                    $this->computePrix($get('voyage_instance_id'), $state);
                                }),

                            Placeholder::make('prix_affiche')
                                ->label('Prix du ticket')
                                ->content(fn () => new HtmlString(
                                    '<span class="text-2xl font-bold text-primary-600">'
                                    . number_format($this->prix, 0, ',', ' ') . ' F CFA</span>'
                                ))
                                ->visible(fn () => $this->prix > 0),
                        ]),

                    Wizard\Step::make('Client')
                        ->icon('heroicon-o-user')
                        ->description('Informations du client')
                        ->schema([
                            TextInput::make('client_nom')
                                ->label('Nom')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Ex: OUEDRAOGO'),

                            TextInput::make('client_prenom')
                                ->label('Prénom')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Ex: Ibrahim'),

                            TextInput::make('client_telephone')
                                ->label('Téléphone (facultatif)')
                                ->tel()
                                ->maxLength(20)
                                ->placeholder('Ex: 70 12 34 56'),
                        ]),

                    Wizard\Step::make('Paiement')
                        ->icon('heroicon-o-banknotes')
                        ->description('Encaissement')
                        ->schema([
                            Placeholder::make('recap_prix')
                                ->label('Montant à encaisser')
                                ->content(fn () => new HtmlString(
                                    '<span class="text-3xl font-bold text-primary-600">'
                                    . number_format($this->prix, 0, ',', ' ') . ' F CFA</span>'
                                )),

                            TextInput::make('montant_recu')
                                ->label('Montant reçu du client (F CFA)')
                                ->numeric()
                                ->required()
                                ->live(debounce: 300)
                                ->afterStateUpdated(function ($state) {
                                    $this->monnaie = max(0, (float) ($state ?? 0) - $this->prix);
                                })
                                ->suffix('F CFA'),

                            Placeholder::make('monnaie_rendue')
                                ->label('Monnaie à rendre')
                                ->content(fn () => new HtmlString(
                                    '<span class="text-3xl font-bold '
                                    . ($this->monnaie > 0 ? 'text-success-600' : 'text-gray-400') . '">'
                                    . number_format($this->monnaie, 0, ',', ' ') . ' F CFA</span>'
                                )),
                        ]),
                ])
                    ->submitAction(new HtmlString(
                        '<button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50">'
                        . '<svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>'
                        . ' Confirmer la Vente</button>'
                    )),
            ])
            ->statePath('data');
    }

    private function computePrix(?string $voyageInstanceId, ?string $typeTicketValue): void
    {
        if (!$voyageInstanceId) {
            $this->prix = 0;
            return;
        }

        $voyageInstance = VoyageInstance::find($voyageInstanceId);

        if (!$voyageInstance) {
            $this->prix = 0;
            return;
        }

        $typeTicket = TypeTicket::tryFrom($typeTicketValue) ?? TypeTicket::AllerSimple;
        $this->prix = $voyageInstance->getPrix($typeTicket);
    }

    public function vendreTicket(): void
    {
        $data = $this->form->getState();

        $montantRecu = (float) ($data['montant_recu'] ?? 0);
        if ($montantRecu < $this->prix) {
            Notification::make()
                ->title('Montant insuffisant')
                ->body('Le montant reçu (' . number_format($montantRecu, 0, ',', ' ')
                    . ' F CFA) est inférieur au prix du ticket ('
                    . number_format($this->prix, 0, ',', ' ') . ' F CFA).')
                ->danger()
                ->send();
            return;
        }

        DB::beginTransaction();
        try {
            $autrePersonne = AutrePersonne::create([
                'first_name' => $data['client_nom'],
                'last_name' => $data['client_prenom'],
                'sexe' => SexeUser::Homme->value,
                'numero' => !empty($data['client_telephone'])
                    ? (int) preg_replace('/\D/', '', $data['client_telephone'])
                    : null,
            ]);

            $voyageInstance = VoyageInstance::findOrFail($data['voyage_instance_id']);
            $placesDisponibles = $voyageInstance->chaiseDispo();

            if (empty($placesDisponibles)) {
                DB::rollBack();
                Notification::make()
                    ->title('Plus de places disponibles')
                    ->body('Ce voyage n\'a plus de places disponibles. Veuillez en choisir un autre.')
                    ->danger()
                    ->send();
                return;
            }

            $typeTicket = TypeTicket::from($data['type_ticket']);
            $prix = $voyageInstance->getPrix($typeTicket);

            $caisse = Caisse::sessionOuverte();

            $ticket = Ticket::create([
                'user_id' => Auth::id(),
                'voyage_id' => $voyageInstance->voyage_id,
                'voyage_instance_id' => $voyageInstance->id,
                'date' => $voyageInstance->date->format('Y-m-d'),
                'type' => $typeTicket->value,
                'statut' => StatutTicket::Payer->value,
                'numero_ticket' => TicketHelpers::generateTicketNumber(),
                'numero_chaise' => TicketHelpers::getNumeroChaise($voyageInstance),
                'code_sms' => TicketHelpers::generateTicketCodeSms(),
                'code_qr' => TicketHelpers::generateTicketCodeQr(),
                'is_my_ticket' => false,
                'autre_personne_id' => $autrePersonne->id,
                'a_bagage' => false,
                'caisse_id' => $caisse?->id,
            ]);

            Payement::create([
                'ticket_id' => $ticket->id,
                'montant' => $prix,
                'statut' => StatutPayement::Complete->value,
                'moyen_payment' => MoyenPayment::ESPECE->value,
            ]);

            DB::commit();

            // Generate QR code + PDF via synchronous events
            PayementEffectuerEvent::dispatch($ticket);
            $ticket->refresh();

            $this->ticketVenduId = $ticket->id;
            $this->monnaie = $montantRecu - $prix;

            Notification::make()
                ->title('Vente effectuée !')
                ->body('Ticket ' . $ticket->numero_ticket . ' vendu avec succès.')
                ->success()
                ->send();

        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            Notification::make()
                ->title('Erreur lors de la vente')
                ->body('Une erreur est survenue. Veuillez réessayer.')
                ->danger()
                ->send();
        }
    }

    public function getTicketVendu(): ?Ticket
    {
        if (!$this->ticketVenduId) {
            return null;
        }

        return Ticket::with([
            'autre_personne',
            'voyageInstance',
        ])->find($this->ticketVenduId);
    }

    public function nouvelleVente(): void
    {
        $this->ticketVenduId = null;
        $this->prix = 0;
        $this->monnaie = 0;
        $this->form->fill([
            'type_ticket' => TypeTicket::AllerSimple->value,
        ]);
    }
}
