<x-filament-panels::page>
    @php
        $ticketVendu = $this->getTicketVendu();
        $caisseOuverte = $this->getCaisseOuverte();
    @endphp

    @if(!$caisseOuverte && !$ticketVendu)
        {{-- No open cash register --}}
        <div class="max-w-lg mx-auto text-center space-y-4 py-8">
            <div class="w-16 h-16 mx-auto bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center">
                <x-heroicon-o-exclamation-triangle class="w-8 h-8 text-amber-500" />
            </div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Caisse non ouverte</h2>
            <p class="text-gray-500 dark:text-gray-400">
                Vous devez ouvrir votre caisse avant de pouvoir effectuer des ventes.
            </p>
            <x-filament::button
                tag="a"
                href="{{ \App\Filament\Compagnie\Pages\GestionCaisse::getUrl() }}"
                icon="heroicon-o-lock-open"
                color="primary"
            >
                Ouvrir ma caisse
            </x-filament::button>
        </div>
    @elseif($ticketVendu)
        <div class="max-w-2xl mx-auto space-y-6">
            {{-- Success header --}}
            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 border border-green-200 dark:border-green-800">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="text-xl font-bold text-green-700 dark:text-green-400">Ticket vendu avec succès !</h2>
                </div>
            </div>

            {{-- Ticket details --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">N° Ticket</p>
                        <p class="font-bold text-lg">{{ $ticketVendu->numero_ticket }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Siège</p>
                        <p class="font-bold text-lg">N° {{ $ticketVendu->numero_chaise }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Client</p>
                        <p class="font-bold">{{ $ticketVendu->autre_personne?->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Type</p>
                        <p class="font-bold">
                            {{ $ticketVendu->type === \App\Enums\TypeTicket::AllerSimple ? 'Aller Simple' : ($ticketVendu->type === \App\Enums\TypeTicket::AllerRetour ? 'Aller Retour' : 'Retour Simple') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Voyage</p>
                        <p class="font-bold">
                            {{ $ticketVendu->voyageInstance?->villeDepart()?->name ?? '?' }}
                            →
                            {{ $ticketVendu->voyageInstance?->villeArrive()?->name ?? '?' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Date & Heure</p>
                        <p class="font-bold">
                            {{ $ticketVendu->voyageInstance?->date?->format('d/m/Y') }}
                            à {{ $ticketVendu->voyageInstance?->heure?->format('H\hi') }}
                        </p>
                    </div>
                </div>

                <hr class="my-4 dark:border-gray-700">

                <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Prix</p>
                        <p class="font-bold text-2xl text-amber-600 dark:text-amber-400">
                            {{ number_format($ticketVendu->prix(), 0, ',', ' ') }} F CFA
                        </p>
                    </div>
                    @if($monnaie > 0)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Monnaie à rendre</p>
                            <p class="font-bold text-2xl text-green-600 dark:text-green-400">
                                {{ number_format($monnaie, 0, ',', ' ') }} F CFA
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3">
                @if($ticketVendu->pdf_uri)
                    <x-filament::button
                        icon="heroicon-o-printer"
                        x-on:click="window.open('{{ asset('storage/' . $ticketVendu->pdf_uri) }}', '_blank')"
                    >
                        Imprimer le Ticket
                    </x-filament::button>
                @endif

                <x-filament::button
                    color="gray"
                    icon="heroicon-o-plus"
                    wire:click="nouvelleVente"
                >
                    Nouvelle Vente
                </x-filament::button>
            </div>
        </div>
    @else
        <form wire:submit="vendreTicket">
            {{ $this->form }}
        </form>
    @endif
</x-filament-panels::page>
