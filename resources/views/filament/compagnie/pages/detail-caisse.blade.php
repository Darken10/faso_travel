<x-filament-panels::page>
    @php
        $caisse = $this->getCaisse();
        $stats = $this->stats;
        $chartData = $this->chartData;
    @endphp

    @if(!$caisse)
        <div class="text-center py-12">
            <p class="text-gray-500">Caisse introuvable.</p>
        </div>
    @else
        <div class="space-y-6">
            {{-- Back Button + Header --}}
            <div class="flex items-center justify-between">
                <a href="{{ url('compagnie/historique-caisses') }}"
                   class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                    <x-heroicon-o-arrow-left class="w-4 h-4" />
                    Retour à l'historique
                </a>
                <x-filament::badge :color="$stats['is_ouverte'] ? 'success' : 'gray'" size="lg">
                    {{ $stats['is_ouverte'] ? 'Ouverte' : 'Fermée' }}
                </x-filament::badge>
            </div>

            {{-- Session Info Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            Session du {{ $caisse->opened_at->format('d/m/Y') }}
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $caisse->opened_at->format('H\hi') }}
                            @if($caisse->closed_at)
                                → {{ $caisse->closed_at->format('H\hi') }}
                            @endif
                            &bull; Durée : {{ $stats['duree'] }}
                            &bull; Caissier : {{ $caisse->user?->name ?? '-' }}
                        </p>
                    </div>
                </div>

                @if($caisse->note_ouverture)
                    <div class="bg-blue-50 dark:bg-blue-900/10 rounded-lg p-3 border border-blue-100 dark:border-blue-800 mb-3">
                        <p class="text-sm text-blue-700 dark:text-blue-300">
                            <span class="font-semibold">Note d'ouverture :</span> {{ $caisse->note_ouverture }}
                        </p>
                    </div>
                @endif
                @if($caisse->note_fermeture)
                    <div class="bg-amber-50 dark:bg-amber-900/10 rounded-lg p-3 border border-amber-100 dark:border-amber-800">
                        <p class="text-sm text-amber-700 dark:text-amber-300">
                            <span class="font-semibold">Note de fermeture :</span> {{ $caisse->note_fermeture }}
                        </p>
                    </div>
                @endif
            </div>

            {{-- Financial Summary --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-banknotes class="w-4 h-4 text-blue-500" />
                        <p class="text-xs text-gray-500 dark:text-gray-400">Fond d'ouverture</p>
                    </div>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                        {{ number_format($stats['montant_ouverture'], 0, ',', ' ') }} F
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-arrow-trending-up class="w-4 h-4 text-green-500" />
                        <p class="text-xs text-gray-500 dark:text-gray-400">Total ventes</p>
                    </div>
                    <p class="text-lg font-bold text-green-600 dark:text-green-400">
                        {{ number_format($stats['total_ventes'], 0, ',', ' ') }} F
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-ticket class="w-4 h-4 text-amber-500" />
                        <p class="text-xs text-gray-500 dark:text-gray-400">Tickets vendus</p>
                    </div>
                    <p class="text-lg font-bold text-amber-600 dark:text-amber-400">
                        {{ $stats['nombre_tickets'] }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center gap-2 mb-1">
                        <x-heroicon-o-calculator class="w-4 h-4 text-purple-500" />
                        <p class="text-xs text-gray-500 dark:text-gray-400">Montant attendu</p>
                    </div>
                    <p class="text-lg font-bold text-purple-600 dark:text-purple-400">
                        {{ number_format($stats['montant_attendu'], 0, ',', ' ') }} F
                    </p>
                </div>

                @if($stats['montant_fermeture'] !== null)
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex items-center gap-2 mb-1">
                            <x-heroicon-o-lock-closed class="w-4 h-4 text-gray-500" />
                            <p class="text-xs text-gray-500 dark:text-gray-400">Montant fermeture</p>
                        </div>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ number_format($stats['montant_fermeture'], 0, ',', ' ') }} F
                        </p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm
                        {{ $stats['ecart'] === 0 ? 'ring-2 ring-green-200 dark:ring-green-800' : ($stats['ecart'] < 0 ? 'ring-2 ring-red-200 dark:ring-red-800' : 'ring-2 ring-blue-200 dark:ring-blue-800') }}">
                        <div class="flex items-center gap-2 mb-1">
                            <x-heroicon-o-scale class="w-4 h-4 {{ $stats['ecart'] === 0 ? 'text-green-500' : ($stats['ecart'] < 0 ? 'text-red-500' : 'text-blue-500') }}" />
                            <p class="text-xs text-gray-500 dark:text-gray-400">Écart</p>
                        </div>
                        <p class="text-lg font-bold {{ $stats['ecart'] === 0 ? 'text-green-600 dark:text-green-400' : ($stats['ecart'] < 0 ? 'text-red-600 dark:text-red-400' : 'text-blue-600 dark:text-blue-400') }}">
                            {{ $stats['ecart'] >= 0 ? '+' : '' }}{{ number_format($stats['ecart'], 0, ',', ' ') }} F
                        </p>
                        <p class="text-xs mt-1 {{ $stats['ecart'] === 0 ? 'text-green-500' : ($stats['ecart'] < 0 ? 'text-red-500' : 'text-blue-500') }}">
                            {{ $stats['ecart'] === 0 ? 'Caisse parfaite !' : ($stats['ecart'] < 0 ? 'Manque en caisse' : 'Excédent en caisse') }}
                        </p>
                    </div>
                @endif
            </div>

            {{-- Charts Section --}}
            @if($stats['nombre_tickets'] > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Hourly Revenue Chart --}}
                    @if(count($chartData['hourly']['labels'] ?? []) > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <x-heroicon-o-chart-bar class="w-4 h-4 text-primary-500" />
                                Ventes par heure
                            </h3>
                            <canvas id="hourlyChart" height="200"></canvas>
                        </div>
                    @endif

                    {{-- Payment Methods Chart --}}
                    @if(count($chartData['methods']['labels'] ?? []) > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <x-heroicon-o-credit-card class="w-4 h-4 text-primary-500" />
                                Répartition par moyen de paiement
                            </h3>
                            <canvas id="paymentMethodsChart" height="200"></canvas>
                        </div>
                    @endif

                    {{-- Tickets per Hour Chart --}}
                    @if(count($chartData['hourly']['labels'] ?? []) > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <x-heroicon-o-ticket class="w-4 h-4 text-primary-500" />
                                Tickets vendus par heure
                            </h3>
                            <canvas id="ticketsHourlyChart" height="200"></canvas>
                        </div>
                    @endif

                    {{-- Destinations Chart --}}
                    @if(count($chartData['destinations']['labels'] ?? []) > 0)
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-sm">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <x-heroicon-o-map-pin class="w-4 h-4 text-primary-500" />
                                Top destinations
                            </h3>
                            <canvas id="destinationsChart" height="200"></canvas>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Tickets Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <x-heroicon-o-queue-list class="w-4 h-4 text-primary-500" />
                        Tickets vendus ({{ $stats['nombre_tickets'] }})
                    </h3>
                </div>

                @if($caisse->tickets->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        Aucun ticket vendu durant cette session.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Ticket</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trajet</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Heure vente</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siège</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Montant</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paiement</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($caisse->tickets->sortBy('created_at') as $ticket)
                                    @php
                                        $payement = $ticket->payements->where('statut', \App\Enums\StatutPayement::Complete)->first();
                                        $instance = $ticket->voyageInstance;
                                    @endphp
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/30">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                                            {{ $ticket->numero_ticket }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $ticket->autre_personne?->first_name ?? '' }}
                                            {{ $ticket->autre_personne?->last_name ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                            @if($instance)
                                                {{ $instance->villeDepart()?->name ?? '?' }}
                                                → {{ $instance->villeArrive()?->name ?? '?' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-500 dark:text-gray-400">
                                            {{ $ticket->created_at->format('H\hi') }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-500">
                                            N° {{ $ticket->numero_chaise ?? '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-right font-semibold text-gray-900 dark:text-white">
                                            {{ $payement ? number_format($payement->montant, 0, ',', ' ') . ' F' : '-' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($payement?->moyen_payment)
                                                <x-filament::badge color="info" size="sm">
                                                    {{ $payement->moyen_payment->value }}
                                                </x-filament::badge>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 dark:bg-gray-900/50">
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-right font-semibold text-gray-900 dark:text-white">
                                        Total
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-lg text-green-600 dark:text-green-400">
                                        {{ number_format($stats['total_ventes'], 0, ',', ' ') }} F
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Chart.js --}}
        @if($stats['nombre_tickets'] > 0)
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const isDark = document.documentElement.classList.contains('dark');
                    const textColor = isDark ? '#9ca3af' : '#6b7280';
                    const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';

                    const chartColors = [
                        'rgba(245, 158, 11, 0.8)',   // amber
                        'rgba(16, 185, 129, 0.8)',    // green
                        'rgba(59, 130, 246, 0.8)',    // blue
                        'rgba(139, 92, 246, 0.8)',    // purple
                        'rgba(236, 72, 153, 0.8)',    // pink
                        'rgba(249, 115, 22, 0.8)',    // orange
                        'rgba(20, 184, 166, 0.8)',    // teal
                        'rgba(239, 68, 68, 0.8)',     // red
                    ];

                    // Hourly Revenue
                    @if(count($chartData['hourly']['labels'] ?? []) > 0)
                    new Chart(document.getElementById('hourlyChart'), {
                        type: 'bar',
                        data: {
                            labels: @json($chartData['hourly']['labels']),
                            datasets: [{
                                label: 'Recette (F CFA)',
                                data: @json($chartData['hourly']['revenue']),
                                backgroundColor: 'rgba(16, 185, 129, 0.7)',
                                borderColor: 'rgba(16, 185, 129, 1)',
                                borderWidth: 1,
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { ticks: { color: textColor }, grid: { color: gridColor } },
                                x: { ticks: { color: textColor }, grid: { display: false } }
                            }
                        }
                    });
                    @endif

                    // Payment Methods
                    @if(count($chartData['methods']['labels'] ?? []) > 0)
                    new Chart(document.getElementById('paymentMethodsChart'), {
                        type: 'doughnut',
                        data: {
                            labels: @json($chartData['methods']['labels']),
                            datasets: [{
                                data: @json($chartData['methods']['values']),
                                backgroundColor: chartColors.slice(0, {{ count($chartData['methods']['labels'] ?? []) }}),
                                borderWidth: 2,
                                borderColor: isDark ? '#1f2937' : '#ffffff',
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: { color: textColor, padding: 16 }
                                }
                            }
                        }
                    });
                    @endif

                    // Tickets per hour
                    @if(count($chartData['hourly']['labels'] ?? []) > 0)
                    new Chart(document.getElementById('ticketsHourlyChart'), {
                        type: 'line',
                        data: {
                            labels: @json($chartData['hourly']['labels']),
                            datasets: [{
                                label: 'Tickets',
                                data: @json($chartData['hourly']['tickets']),
                                borderColor: 'rgba(245, 158, 11, 1)',
                                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: 'rgba(245, 158, 11, 1)',
                                pointRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { ticks: { color: textColor, stepSize: 1 }, grid: { color: gridColor } },
                                x: { ticks: { color: textColor }, grid: { display: false } }
                            }
                        }
                    });
                    @endif

                    // Destinations
                    @if(count($chartData['destinations']['labels'] ?? []) > 0)
                    new Chart(document.getElementById('destinationsChart'), {
                        type: 'bar',
                        data: {
                            labels: @json($chartData['destinations']['labels']),
                            datasets: [{
                                label: 'Tickets',
                                data: @json($chartData['destinations']['values']),
                                backgroundColor: chartColors.slice(0, {{ count($chartData['destinations']['labels'] ?? []) }}),
                                borderWidth: 0,
                                borderRadius: 6,
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true,
                            plugins: { legend: { display: false } },
                            scales: {
                                x: { ticks: { color: textColor, stepSize: 1 }, grid: { color: gridColor } },
                                y: { ticks: { color: textColor }, grid: { display: false } }
                            }
                        }
                    });
                    @endif
                });
            </script>
        @endif
    @endif
</x-filament-panels::page>
