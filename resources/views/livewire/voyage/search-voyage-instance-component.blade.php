<div>
    {{-- Hero Section --}}
    <div class="text-center mb-10">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-50 dark:bg-primary-900/20 rounded-full mb-4">
            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Recherche de voyages</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold text-surface-900 dark:text-white mb-3">Payez vos tickets de voyage en toute confiance</h1>
        <p class="text-surface-500 dark:text-surface-400 max-w-2xl mx-auto">Trouvez les meilleures offres sur les voyages. Votre voyage confortable commence ici.</p>
    </div>

    {{-- Search Form --}}
    <div class="card max-w-4xl mx-auto mb-10">
        {{-- Transport type tabs --}}
        <div class="flex gap-2 mb-6 overflow-x-auto pb-1">
            <button class="btn-sm btn-primary">
                <span>🚌</span> Car
            </button>
            <button class="btn-sm btn-ghost">
                <span>🚆</span> Train
            </button>
            <button class="btn-sm btn-ghost">
                <span>✈️</span> Vol
            </button>
        </div>

        {{-- Search fields --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div>
                <label class="input-label">Départ</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <input wire:model="villeDepart" type="text" placeholder="Ville de départ" class="input pl-10" />
                </div>
            </div>
            <div>
                <label class="input-label">Destination</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                    </div>
                    <input wire:model="villeArrivee" type="text" placeholder="Ville d'arrivée" class="input pl-10" />
                </div>
            </div>
            <div>
                <label class="input-label">Date de départ</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <input wire:model="date" type="date" class="input pl-10" />
                </div>
            </div>
            <div>
                <label class="input-label">Compagnie</label>
                <select wire:model="compagnie" class="input">
                    <option value="">Toutes</option>
                    @foreach($allCompagnies as $compagnie)
                        <option value="{{$compagnie->id}}">{{$compagnie->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end">
            <button wire:click="updateVoyageInstanceListe" class="btn-primary">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                Rechercher
            </button>
        </div>
    </div>

    {{-- Results --}}
    @if($voyageInstances->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 max-w-6xl mx-auto">
            @foreach ($voyageInstances as $voyageInstance)
                <div class="card group hover:shadow-elevated hover:-translate-y-0.5 transition-all duration-300">
                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->voyage->compagnie->name }}</h3>
                        <div class="flex items-center gap-1.5 text-sm text-surface-500 dark:text-surface-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                            {{ $voyageInstance->date->format('d M Y') }}
                        </div>
                    </div>

                    {{-- Route --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-surface-900 dark:text-white">{{ $voyageInstance->villeDepart()->name }}</p>
                            <p class="text-xs text-surface-500 dark:text-surface-400">{{ $voyageInstance->gareDepart()->name }}</p>
                            <p class="text-xs text-surface-400 dark:text-surface-500">{{ $voyageInstance->heure->format('H:i') }}</p>
                        </div>
                        <div class="flex flex-col items-center flex-shrink-0 px-2">
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                                <div class="w-10 h-px bg-surface-300 dark:bg-surface-600"></div>
                                <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" /></svg>
                                <div class="w-10 h-px bg-surface-300 dark:bg-surface-600"></div>
                                <div class="w-2 h-2 rounded-full bg-accent-500"></div>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0 text-right">
                            <p class="font-bold text-surface-900 dark:text-white">{{ $voyageInstance->villeArrive()->name }}</p>
                            <p class="text-xs text-surface-500 dark:text-surface-400">{{ $voyageInstance->gareArrive()->gare }}</p>
                            <p class="text-xs text-surface-400 dark:text-surface-500">{{ $voyageInstance->heure->addHours(2)->format('H:i') }}</p>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center justify-between pt-4 border-t border-surface-100 dark:border-surface-700">
                        <div>
                            <p class="text-xl font-bold text-primary-600 dark:text-primary-400">{{ number_format($voyageInstance->getPrix(App\Enums\TypeTicket::AllerSimple), 0, ',', ' ') }} <span class="text-sm font-normal text-surface-500">XOF</span></p>
                        </div>
                        <a href="{{ route('voyage.instance.show', $voyageInstance->id) }}" class="btn-primary btn-sm">
                            Sélectionner
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty state --}}
        <div class="card text-center py-16 max-w-lg mx-auto">
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-surface-100 dark:bg-surface-800 flex items-center justify-center">
                <svg class="w-10 h-10 text-surface-400 dark:text-surface-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-surface-900 dark:text-white mb-2">Aucun voyage disponible</h3>
            <p class="text-surface-500 dark:text-surface-400">Veuillez modifier vos critères de recherche</p>
        </div>
    @endif
</div>
