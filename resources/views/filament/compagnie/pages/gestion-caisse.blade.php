<x-filament-panels::page>
    @php
        $caisse = $this->getCaisseOuverte();
        $stats = $this->stats;
    @endphp

    @if($caisse)
        {{-- ===== CAISSE OUVERTE ===== --}}
        <div class="space-y-6">
            {{-- Status Banner --}}
            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-5 border border-green-200 dark:border-green-800">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        <div>
                            <h2 class="text-lg font-bold text-green-700 dark:text-green-400">Caisse Ouverte</h2>
                            <p class="text-sm text-green-600 dark:text-green-500">
                                Ouverte le {{ $caisse->opened_at->format('d/m/Y') }} à {{ $caisse->opened_at->format('H\hi') }}
                                &bull; Durée : {{ $caisse->opened_at->diffForHumans(now(), true) }}
                            </p>
                        </div>
                    </div>
                    <x-filament::badge color="success" size="lg">
                        Active
                    </x-filament::badge>
                </div>
            </div>

            {{-- Live Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-banknotes class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Fond d'ouverture</p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ number_format($stats['montant_ouverture'], 0, ',', ' ') }} F
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-arrow-trending-up class="w-5 h-5 text-green-600 dark:text-green-400" />
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Ventes réalisées</p>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400">
                                {{ number_format($stats['total_ventes'], 0, ',', ' ') }} F
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-ticket class="w-5 h-5 text-amber-600 dark:text-amber-400" />
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Tickets vendus</p>
                            <p class="text-xl font-bold text-amber-600 dark:text-amber-400">
                                {{ $stats['nombre_tickets'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <x-heroicon-o-calculator class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Montant attendu en caisse</p>
                            <p class="text-xl font-bold text-purple-600 dark:text-purple-400">
                                {{ number_format($stats['montant_courant'], 0, ',', ' ') }} F
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Note d'ouverture --}}
            @if($caisse->note_ouverture)
                <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-4 border border-blue-100 dark:border-blue-800">
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        <span class="font-semibold">Note :</span> {{ $caisse->note_ouverture }}
                    </p>
                </div>
            @endif

            {{-- Fermeture Form --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <x-heroicon-o-lock-closed class="w-5 h-5 text-red-500" />
                    Fermer la Caisse
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Comptez l'argent en caisse et saisissez le montant total pour fermer votre session.
                </p>
                <form wire:submit="fermerCaisse" class="space-y-4">
                    {{ $this->fermetureForm }}
                    <div class="flex justify-end">
                        <x-filament::button type="submit" color="danger" icon="heroicon-o-lock-closed">
                            Fermer la caisse
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    @else
        {{-- ===== AUCUNE CAISSE OUVERTE ===== --}}
        <div class="max-w-xl mx-auto space-y-6">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                    <x-heroicon-o-lock-closed class="w-10 h-10 text-gray-400" />
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Caisse fermée</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Ouvrez votre caisse pour commencer à vendre des tickets.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <x-heroicon-o-lock-open class="w-5 h-5 text-green-500" />
                    Ouvrir la Caisse
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Renseignez le montant avec lequel vous démarrez (fond de caisse).
                </p>
                <form wire:submit="ouvrirCaisse" class="space-y-4">
                    {{ $this->ouvertureForm }}
                    <div class="flex justify-end">
                        <x-filament::button type="submit" color="success" icon="heroicon-o-lock-open">
                            Ouvrir la caisse
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</x-filament-panels::page>
