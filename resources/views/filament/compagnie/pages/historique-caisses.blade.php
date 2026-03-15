<x-filament-panels::page>
    @php
        $caisses = $this->getCaisses();
        $globalStats = $this->getGlobalStats();
    @endphp

    <div class="space-y-6">
        {{-- Global Summary --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total sessions</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $globalStats['total_sessions'] }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                <p class="text-sm text-gray-500 dark:text-gray-400">Sessions fermées</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $globalStats['sessions_fermees'] }}</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                <p class="text-sm text-gray-500 dark:text-gray-400">Total ventes</p>
                <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ number_format($globalStats['total_ventes'], 0, ',', ' ') }} F</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                <p class="text-sm text-gray-500 dark:text-gray-400">Tickets vendus</p>
                <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $globalStats['total_tickets'] }}</p>
            </div>
        </div>

        {{-- Sessions List --}}
        @if($caisses->isEmpty())
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                    <x-heroicon-o-clock class="w-8 h-8 text-gray-400" />
                </div>
                <p class="text-gray-500 dark:text-gray-400">Aucune session de caisse enregistrée.</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($caisses as $caisse)
                    @php
                        $isOuverte = $caisse->statut === \App\Enums\StatutCaisse::Ouverte;
                        $totalVentes = $caisse->totalVentes();
                        $nbTickets = $caisse->nombreTickets();
                        $ecart = $caisse->ecart();
                    @endphp
                    <a href="{{ url('compagnie/detail-caisse/' . $caisse->id) }}"
                       class="block bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md hover:border-primary-300 dark:hover:border-primary-600 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            {{-- Left: Date and status --}}
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center shrink-0
                                    {{ $isOuverte ? 'bg-green-100 dark:bg-green-900/30' : 'bg-gray-100 dark:bg-gray-700' }}">
                                    @if($isOuverte)
                                        <x-heroicon-o-lock-open class="w-6 h-6 text-green-600 dark:text-green-400" />
                                    @else
                                        <x-heroicon-o-lock-closed class="w-6 h-6 text-gray-500 dark:text-gray-400" />
                                    @endif
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400">
                                            {{ $caisse->opened_at->format('d/m/Y') }}
                                        </h3>
                                        <x-filament::badge :color="$isOuverte ? 'success' : 'gray'" size="sm">
                                            {{ $isOuverte ? 'Ouverte' : 'Fermée' }}
                                        </x-filament::badge>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $caisse->opened_at->format('H\hi') }}
                                        @if($caisse->closed_at)
                                            → {{ $caisse->closed_at->format('H\hi') }}
                                            <span class="text-gray-400">({{ $caisse->opened_at->diffForHumans($caisse->closed_at, true) }})</span>
                                        @else
                                            → <span class="text-green-600 dark:text-green-400">en cours</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Right: Quick stats --}}
                            <div class="flex items-center gap-6 text-sm">
                                <div class="text-center">
                                    <p class="text-gray-400 dark:text-gray-500">Tickets</p>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $nbTickets }}</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-400 dark:text-gray-500">Ventes</p>
                                    <p class="font-bold text-green-600 dark:text-green-400">{{ number_format($totalVentes, 0, ',', ' ') }} F</p>
                                </div>
                                @if(!$isOuverte && $ecart !== null)
                                    <div class="text-center">
                                        <p class="text-gray-400 dark:text-gray-500">Écart</p>
                                        <p class="font-bold {{ $ecart === 0 ? 'text-green-600 dark:text-green-400' : ($ecart > 0 ? 'text-blue-600 dark:text-blue-400' : 'text-red-600 dark:text-red-400') }}">
                                            {{ $ecart >= 0 ? '+' : '' }}{{ number_format($ecart, 0, ',', ' ') }} F
                                        </p>
                                    </div>
                                @endif
                                <div class="pl-2">
                                    <x-heroicon-o-chevron-right class="w-5 h-5 text-gray-400 group-hover:text-primary-500 transition-colors" />
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-filament-panels::page>
