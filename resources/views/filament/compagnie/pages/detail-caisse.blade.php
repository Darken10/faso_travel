<x-filament-panels::page>
    @php
        $caisse   = $this->getCaisse();
        $stats    = $this->stats;
        $chartData = $this->chartData;

        // Écart helpers
        $ecartColor = match(true) {
            $stats['ecart'] === 0  => ['text' => 'text-emerald-600 dark:text-emerald-400', 'bg' => 'bg-emerald-50 dark:bg-emerald-900/20', 'border' => 'border-emerald-200 dark:border-emerald-700', 'icon' => 'text-emerald-500', 'label' => 'Caisse parfaite'],
            $stats['ecart'] < 0   => ['text' => 'text-red-600 dark:text-red-400',         'bg' => 'bg-red-50 dark:bg-red-900/20',           'border' => 'border-red-200 dark:border-red-700',         'icon' => 'text-red-500',    'label' => 'Manque en caisse'],
            default               => ['text' => 'text-blue-600 dark:text-blue-400',        'bg' => 'bg-blue-50 dark:bg-blue-900/20',          'border' => 'border-blue-200 dark:border-blue-700',        'icon' => 'text-blue-500',   'label' => 'Excédent'],
        };
    @endphp

    @if(!$caisse)
        <div class="flex flex-col items-center justify-center py-20 gap-4 text-gray-400">
            <x-heroicon-o-inbox class="w-16 h-16" />
            <p class="text-lg font-medium">Caisse introuvable.</p>
            <a href="{{ url('compagnie/historique-caisses') }}"
               class="text-sm text-primary-600 dark:text-primary-400 hover:underline flex items-center gap-1">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                Retour à l'historique
            </a>
        </div>
    @else
    <div class="space-y-6">

        {{-- ─── Navigation bar ───────────────────────────────────────── --}}
        <div class="flex items-center justify-between flex-wrap gap-3">
            <a href="{{ url('compagnie/historique-caisses') }}"
               class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 dark:text-gray-400
                      hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                <x-heroicon-o-arrow-left class="w-4 h-4" />
                Retour à l'historique
            </a>
            <div class="flex items-center gap-3">
                @if($stats['is_ouverte'])
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 ring-1 ring-emerald-200 dark:ring-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Session en cours
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 ring-1 ring-gray-200 dark:ring-gray-600">
                        <x-heroicon-o-lock-closed class="w-3.5 h-3.5" />
                        Session clôturée
                    </span>
                @endif
            </div>
        </div>

        {{-- ─── Hero / Session Info Card ─────────────────────────────── --}}
        <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            {{-- Decorative gradient strip --}}
            <div class="absolute inset-x-0 top-0 h-1 {{ $stats['is_ouverte'] ? 'bg-gradient-to-r from-emerald-400 to-teal-500' : 'bg-gradient-to-r from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-500' }}"></div>

            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    {{-- Caissier avatar + info --}}
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl {{ $stats['is_ouverte'] ? 'bg-emerald-100 dark:bg-emerald-900/30' : 'bg-gray-100 dark:bg-gray-700' }} flex items-center justify-center">
                            <x-heroicon-o-user class="w-6 h-6 {{ $stats['is_ouverte'] ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-500 dark:text-gray-400' }}" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-400 dark:text-gray-500 uppercase tracking-wide">Caissier</p>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white leading-tight">
                                {{ $caisse->user?->name ?? '—' }}
                            </h2>
                        </div>
                    </div>

                    {{-- Session timeline --}}
                    <div class="text-right">
                        <p class="text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wide mb-1">Session</p>
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                            {{ $caisse->opened_at->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                            {{ $caisse->opened_at->format('H\hi') }}
                            @if($caisse->closed_at)
                                <span class="mx-1">→</span>{{ $caisse->closed_at->format('H\hi') }}
                            @else
                                <span class="mx-1">·</span>en cours
                            @endif
                            <span class="mx-1">·</span>{{ $stats['duree'] }}
                        </p>
                    </div>
                </div>

                {{-- Notes --}}
                @if($caisse->note_ouverture || $caisse->note_fermeture)
                    <div class="mt-4 flex flex-col sm:flex-row gap-3">
                        @if($caisse->note_ouverture)
                            <div class="flex-1 flex items-start gap-2 bg-blue-50 dark:bg-blue-900/15 rounded-xl p-3 border border-blue-100 dark:border-blue-800/50">
                                <x-heroicon-o-chat-bubble-left-ellipsis class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" />
                                <div>
                                    <p class="text-xs font-semibold text-blue-600 dark:text-blue-400 mb-0.5">Note d'ouverture</p>
                                    <p class="text-sm text-blue-700 dark:text-blue-300">{{ $caisse->note_ouverture }}</p>
                                </div>
                            </div>
                        @endif
                        @if($caisse->note_fermeture)
                            <div class="flex-1 flex items-start gap-2 bg-amber-50 dark:bg-amber-900/15 rounded-xl p-3 border border-amber-100 dark:border-amber-800/50">
                                <x-heroicon-o-chat-bubble-left-ellipsis class="w-4 h-4 text-amber-400 flex-shrink-0 mt-0.5" />
                                <div>
                                    <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 mb-0.5">Note de fermeture</p>
                                    <p class="text-sm text-amber-700 dark:text-amber-300">{{ $caisse->note_fermeture }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- ─── KPI Cards ────────────────────────────────────────────── --}}
        @php
            $kpiCards = [
                [
                    'label'   => 'Fond d\'ouverture',
                    'value'   => number_format($stats['montant_ouverture'], 0, ',', ' ') . ' F',
                    'sub'     => 'Montant initial en caisse',
                    'icon'    => 'heroicon-o-banknotes',
                    'color'   => 'blue',
                    'iconBg'  => 'bg-blue-100 dark:bg-blue-900/30',
                    'iconCol' => 'text-blue-600 dark:text-blue-400',
                    'valCol'  => 'text-blue-700 dark:text-blue-300',
                    'border'  => 'border-t-blue-400',
                ],
                [
                    'label'   => 'Total ventes',
                    'value'   => number_format($stats['total_ventes'], 0, ',', ' ') . ' F',
                    'sub'     => 'Recette brute de la session',
                    'icon'    => 'heroicon-o-arrow-trending-up',
                    'color'   => 'emerald',
                    'iconBg'  => 'bg-emerald-100 dark:bg-emerald-900/30',
                    'iconCol' => 'text-emerald-600 dark:text-emerald-400',
                    'valCol'  => 'text-emerald-700 dark:text-emerald-300',
                    'border'  => 'border-t-emerald-400',
                ],
                [
                    'label'   => 'Tickets vendus',
                    'value'   => (string) $stats['nombre_tickets'],
                    'sub'     => 'Nombre de billets émis',
                    'icon'    => 'heroicon-o-ticket',
                    'color'   => 'amber',
                    'iconBg'  => 'bg-amber-100 dark:bg-amber-900/30',
                    'iconCol' => 'text-amber-600 dark:text-amber-400',
                    'valCol'  => 'text-amber-700 dark:text-amber-300',
                    'border'  => 'border-t-amber-400',
                ],
                [
                    'label'   => 'Montant attendu',
                    'value'   => number_format($stats['montant_attendu'], 0, ',', ' ') . ' F',
                    'sub'     => 'Fond + ventes théoriques',
                    'icon'    => 'heroicon-o-calculator',
                    'color'   => 'violet',
                    'iconBg'  => 'bg-violet-100 dark:bg-violet-900/30',
                    'iconCol' => 'text-violet-600 dark:text-violet-400',
                    'valCol'  => 'text-violet-700 dark:text-violet-300',
                    'border'  => 'border-t-violet-400',
                ],
            ];
        @endphp

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($kpiCards as $card)
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700
                            border-t-4 {{ $card['border'] }} shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide leading-tight">
                                {{ $card['label'] }}
                            </p>
                            <div class="w-8 h-8 rounded-lg {{ $card['iconBg'] }} flex items-center justify-center flex-shrink-0">
                                <x-dynamic-component :component="$card['icon']" class="w-4 h-4 {{ $card['iconCol'] }}" />
                            </div>
                        </div>
                        <p class="text-2xl font-black {{ $card['valCol'] }} leading-none tracking-tight">
                            {{ $card['value'] }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1.5">{{ $card['sub'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ─── Cash Flow Timeline (only when closed) ────────────────── --}}
        @if($stats['montant_fermeture'] !== null)
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-5 flex items-center gap-2">
                    <x-heroicon-o-arrows-right-left class="w-4 h-4 text-gray-400" />
                    Récapitulatif financier de clôture
                </h3>

                {{-- Horizontal flow --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
                    {{-- Opening --}}
                    <div class="text-center px-4">
                        <p class="text-xs font-medium text-gray-400 uppercase mb-1">Fond initial</p>
                        <p class="text-xl font-extrabold text-blue-600 dark:text-blue-400">
                            {{ number_format($stats['montant_ouverture'], 0, ',', ' ') }} F
                        </p>
                    </div>

                    <div class="hidden sm:flex items-center gap-1 text-gray-300 dark:text-gray-600">
                        <div class="w-8 h-px bg-current"></div>
                        <span class="text-lg font-bold text-emerald-500">+</span>
                    </div>

                    {{-- Sales --}}
                    <div class="text-center px-4">
                        <p class="text-xs font-medium text-gray-400 uppercase mb-1">Ventes</p>
                        <p class="text-xl font-extrabold text-emerald-600 dark:text-emerald-400">
                            {{ number_format($stats['total_ventes'], 0, ',', ' ') }} F
                        </p>
                    </div>

                    <div class="hidden sm:flex items-center gap-1 text-gray-300 dark:text-gray-600">
                        <div class="w-8 h-px bg-current"></div>
                        <span class="text-lg font-bold text-violet-500">=</span>
                    </div>

                    {{-- Expected --}}
                    <div class="text-center px-4 py-2 bg-violet-50 dark:bg-violet-900/20 rounded-xl border border-violet-100 dark:border-violet-800">
                        <p class="text-xs font-medium text-violet-500 uppercase mb-1">Attendu</p>
                        <p class="text-xl font-extrabold text-violet-700 dark:text-violet-300">
                            {{ number_format($stats['montant_attendu'], 0, ',', ' ') }} F
                        </p>
                    </div>

                    <div class="hidden sm:flex items-center gap-1 text-gray-300 dark:text-gray-600">
                        <div class="w-8 h-px bg-current"></div>
                        <x-heroicon-o-arrow-right class="w-4 h-4" />
                    </div>

                    {{-- Closing --}}
                    <div class="text-center px-4">
                        <p class="text-xs font-medium text-gray-400 uppercase mb-1">Clôturé avec</p>
                        <p class="text-xl font-extrabold text-gray-700 dark:text-gray-200">
                            {{ number_format($stats['montant_fermeture'], 0, ',', ' ') }} F
                        </p>
                    </div>

                    <div class="hidden sm:flex items-center gap-1 text-gray-300 dark:text-gray-600">
                        <div class="w-8 h-px bg-current"></div>
                        <span class="text-lg font-bold {{ $ecartColor['icon'] }}">≈</span>
                    </div>

                    {{-- Écart --}}
                    <div class="text-center px-4 py-2 rounded-xl border {{ $ecartColor['bg'] }} {{ $ecartColor['border'] }}">
                        <p class="text-xs font-medium uppercase mb-1 {{ $ecartColor['icon'] }}">Écart</p>
                        <p class="text-xl font-extrabold {{ $ecartColor['text'] }}">
                            {{ $stats['ecart'] >= 0 ? '+' : '' }}{{ number_format($stats['ecart'], 0, ',', ' ') }} F
                        </p>
                        <p class="text-xs {{ $ecartColor['icon'] }} mt-0.5">{{ $ecartColor['label'] }}</p>
                    </div>
                </div>

                {{-- Progress bar --}}
                @php
                    $attendu = max($stats['montant_attendu'], 1);
                    $pct = min(100, round(($stats['montant_fermeture'] / $attendu) * 100));
                @endphp
                <div class="mt-5">
                    <div class="flex justify-between text-xs text-gray-400 mb-1">
                        <span>Couverture de la caisse</span>
                        <span>{{ $pct }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-2.5 overflow-hidden">
                        <div class="h-2.5 rounded-full transition-all duration-700
                            {{ $pct >= 100 ? 'bg-emerald-500' : ($pct >= 90 ? 'bg-amber-500' : 'bg-red-500') }}"
                             style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ─── Charts ────────────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            {{-- Ventes par heure --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <x-heroicon-o-chart-bar class="w-4 h-4 text-emerald-500" />
                    Recette par heure
                </h3>
                @if($stats['nombre_tickets'] > 0 && count($chartData['hourly']['labels'] ?? []) > 0)
                    <canvas id="hourlyChart" height="220"></canvas>
                @else
                    <div class="flex flex-col items-center justify-center h-40 text-gray-300 dark:text-gray-600 gap-2">
                        <x-heroicon-o-chart-bar class="w-10 h-10" />
                        <p class="text-xs">Aucune vente enregistrée</p>
                    </div>
                @endif
            </div>

            {{-- Répartition paiements --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <x-heroicon-o-credit-card class="w-4 h-4 text-violet-500" />
                    Répartition des paiements
                </h3>
                @if($stats['nombre_tickets'] > 0 && count($chartData['methods']['labels'] ?? []) > 0)
                    <canvas id="paymentMethodsChart" height="220"></canvas>
                @else
                    <div class="flex flex-col items-center justify-center h-40 text-gray-300 dark:text-gray-600 gap-2">
                        <x-heroicon-o-credit-card class="w-10 h-10" />
                        <p class="text-xs">Aucun paiement enregistré</p>
                    </div>
                @endif
            </div>

            {{-- Tickets par heure --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <x-heroicon-o-ticket class="w-4 h-4 text-amber-500" />
                    Tickets vendus par heure
                </h3>
                @if($stats['nombre_tickets'] > 0 && count($chartData['hourly']['labels'] ?? []) > 0)
                    <canvas id="ticketsHourlyChart" height="220"></canvas>
                @else
                    <div class="flex flex-col items-center justify-center h-40 text-gray-300 dark:text-gray-600 gap-2">
                        <x-heroicon-o-ticket class="w-10 h-10" />
                        <p class="text-xs">Aucun ticket vendu</p>
                    </div>
                @endif
            </div>

            {{-- Top destinations --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                    <x-heroicon-o-map-pin class="w-4 h-4 text-rose-500" />
                    Destinations populaires
                </h3>
                @if($stats['nombre_tickets'] > 0 && count($chartData['destinations']['labels'] ?? []) > 0)
                    <canvas id="destinationsChart" height="220"></canvas>
                @else
                    <div class="flex flex-col items-center justify-center h-40 text-gray-300 dark:text-gray-600 gap-2">
                        <x-heroicon-o-map-pin class="w-10 h-10" />
                        <p class="text-xs">Aucune destination</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- ─── Tickets Table ─────────────────────────────────────────── --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                    <x-heroicon-o-queue-list class="w-4 h-4 text-primary-500" />
                    Détail des tickets
                </h3>
                @if($stats['nombre_tickets'] > 0)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400">
                        {{ $stats['nombre_tickets'] }} ticket{{ $stats['nombre_tickets'] > 1 ? 's' : '' }}
                    </span>
                @endif
            </div>

            @if($caisse->tickets->isEmpty())
                <div class="flex flex-col items-center justify-center py-12 gap-3 text-gray-300 dark:text-gray-600">
                    <x-heroicon-o-ticket class="w-12 h-12" />
                    <p class="text-sm font-medium text-gray-400">Aucun ticket vendu durant cette session</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-900/40">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">N° Ticket</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">Client</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">Trajet</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">Heure</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">Siège</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wide">Montant</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wide">Paiement</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                            @foreach($caisse->tickets->sortBy('created_at') as $ticket)
                                @php
                                    $payement = $ticket->payements->where('statut', \App\Enums\StatutPayement::Complete)->first();
                                    $instance  = $ticket->voyageInstance;
                                @endphp
                                <tr class="hover:bg-gray-50/70 dark:hover:bg-gray-900/30 transition-colors">
                                    <td class="px-4 py-3 font-mono font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $ticket->numero_ticket }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                        {{ trim(($ticket->autre_personne?->first_name ?? '') . ' ' . ($ticket->autre_personne?->last_name ?? '')) ?: '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                        @if($instance)
                                            <span class="inline-flex items-center gap-1">
                                                {{ $instance->villeDepart()?->name ?? '?' }}
                                                <x-heroicon-o-arrow-right class="w-3 h-3 text-gray-400 flex-shrink-0" />
                                                {{ $instance->villeArrive()?->name ?? '?' }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400 font-medium">
                                        {{ $ticket->created_at->format('H\hi') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 dark:text-gray-400">
                                        {{ $ticket->numero_chaise ? 'N°' . $ticket->numero_chaise : '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        @if($payement)
                                            <span class="font-bold text-gray-900 dark:text-white">
                                                {{ number_format($payement->montant, 0, ',', ' ') }} F
                                            </span>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($payement?->moyen_payment)
                                            <x-filament::badge color="info" size="sm">
                                                {{ $payement->moyen_payment->value }}
                                            </x-filament::badge>
                                        @else
                                            <span class="text-gray-400">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50 dark:bg-gray-900/40 border-t-2 border-gray-200 dark:border-gray-700">
                                <td colspan="5" class="px-4 py-3 text-right text-sm font-bold text-gray-700 dark:text-gray-300">
                                    Total encaissé
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <span class="text-lg font-extrabold text-emerald-600 dark:text-emerald-400">
                                        {{ number_format($stats['total_ventes'], 0, ',', ' ') }} F
                                    </span>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>

    </div><!-- /space-y-6 -->

    {{-- ─── Chart.js ──────────────────────────────────────────────────── --}}
    @if($stats['nombre_tickets'] > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const isDark    = document.documentElement.classList.contains('dark');
                const textColor = isDark ? '#9ca3af' : '#6b7280';
                const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

                const palette = [
                    '#10b981','#f59e0b','#6366f1','#f43f5e',
                    '#0ea5e9','#84cc16','#ec4899','#14b8a6',
                ];
                const paletteAlpha = palette.map(c => c + 'cc'); // ~80% opacity

                const sharedOptions = {
                    responsive: true,
                    animation: { duration: 600 },
                };

                @if(count($chartData['hourly']['labels'] ?? []) > 0)
                // — Recette par heure
                new Chart(document.getElementById('hourlyChart'), {
                    type: 'bar',
                    data: {
                        labels: @json($chartData['hourly']['labels']),
                        datasets: [{
                            label: 'F CFA',
                            data: @json($chartData['hourly']['revenue']),
                            backgroundColor: '#10b98180',
                            borderColor: '#10b981',
                            borderWidth: 1.5,
                            borderRadius: 8,
                            borderSkipped: false,
                        }]
                    },
                    options: {
                        ...sharedOptions,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { ticks: { color: textColor }, grid: { color: gridColor } },
                            x: { ticks: { color: textColor }, grid: { display: false } }
                        }
                    }
                });
                @endif

                @if(count($chartData['methods']['labels'] ?? []) > 0)
                // — Répartition paiements
                new Chart(document.getElementById('paymentMethodsChart'), {
                    type: 'doughnut',
                    data: {
                        labels: @json($chartData['methods']['labels']),
                        datasets: [{
                            data: @json($chartData['methods']['values']),
                            backgroundColor: paletteAlpha.slice(0, @json(count($chartData['methods']['labels'] ?? []))),
                            borderColor: isDark ? '#1f2937' : '#ffffff',
                            borderWidth: 3,
                            hoverOffset: 8,
                        }]
                    },
                    options: {
                        ...sharedOptions,
                        cutout: '60%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { color: textColor, padding: 16, usePointStyle: true, pointStyle: 'circle' }
                            }
                        }
                    }
                });
                @endif

                @if(count($chartData['hourly']['labels'] ?? []) > 0)
                // — Tickets par heure
                new Chart(document.getElementById('ticketsHourlyChart'), {
                    type: 'line',
                    data: {
                        labels: @json($chartData['hourly']['labels']),
                        datasets: [{
                            label: 'Tickets',
                            data: @json($chartData['hourly']['tickets']),
                            borderColor: '#f59e0b',
                            backgroundColor: '#f59e0b18',
                            fill: true,
                            tension: 0.45,
                            pointBackgroundColor: '#f59e0b',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                        }]
                    },
                    options: {
                        ...sharedOptions,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { ticks: { color: textColor, stepSize: 1 }, grid: { color: gridColor }, min: 0 },
                            x: { ticks: { color: textColor }, grid: { display: false } }
                        }
                    }
                });
                @endif

                @if(count($chartData['destinations']['labels'] ?? []) > 0)
                // — Top destinations
                new Chart(document.getElementById('destinationsChart'), {
                    type: 'bar',
                    data: {
                        labels: @json($chartData['destinations']['labels']),
                        datasets: [{
                            label: 'Tickets',
                            data: @json($chartData['destinations']['values']),
                            backgroundColor: paletteAlpha.slice(0, @json(count($chartData['destinations']['labels'] ?? []))),
                            borderWidth: 0,
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        ...sharedOptions,
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

    @endif {{-- /if $caisse --}}
</x-filament-panels::page>
