<div class="my-4">

  {{--  <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">

        <div class="pb-4 bg-white dark:bg-gray-900 flex gap-2 justify-between mx-4 mt-3">
            <div >
                <label for="table-search" class="sr-only">Compagnie</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="compagnieQuery"  placeholder="Compagnie ..." type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div>
                <label for="table-search" class="sr-only">Depart</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="departQuery" placeholder="Depart ..." type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg  bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
            </div>
            <div>
                <label for="table-search" class="sr-only">Arriver</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="arriverQuery" placeholder="Arriver ..." type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
            </div>
            <div>
                <label for="table-search" class="sr-only">Heure </label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live="heureQuery"  type="time" id="table-search" placeholder="Date & Heure ..." class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-50 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                </div>
            </div>
        </div>





       --}}{{-- <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Compagnie
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Depart
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Arriver
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Heure
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prix
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($voyages as $voyage)
                    <tr wire:click="redirecteToShow({{ $voyage->id }})" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $voyage->compagnie->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $voyage->trajet->depart->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $voyage->trajet->arriver->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $voyage->heure->format('H\h i\m\n') }}
                        </td>
                        <td class="px-6 py-4">

                            {{ $voyage->prix }} XOF
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('voyage.show',$voyage) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" >
                            <p class="flex justify-center my-3 text-2xl font-bold" >Aucun Voyages </p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>--}}{{--
    </div>

--}}


    <!-- Section Hero -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Titre et description -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Réservez votre voyage en toute confiance</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Trouvez les meilleures offres sur les vols, trains et bus dans le monde entier. Votre voyage confortable commence ici.</p>
        </div>

        <!-- Formulaire de recherche -->
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-4xl mx-auto">
            <!-- Boutons de sélection du transport -->
            <div class="flex space-x-4 mb-6 overflow-x-auto pb-2">
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg transition bg-indigo-100 text-indigo-700 hover:bg-gray-100">
                    <span>✈️</span>
                    <span>Vol</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg transition hover:bg-gray-100">
                    <span>🚆</span>
                    <span>Train</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg transition hover:bg-gray-100">
                    <span>🚌</span>
                    <span>Bus</span>
                </button>
            </div>

            <!-- Champs de saisie -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Champ "From" -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>📍</span>
                        <input type="text" placeholder="De" class="w-full focus:outline-none ml-2" />
                    </div>
                </div>
                <!-- Champ "To" -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>📍</span>
                        <input type="text" placeholder="À" class="w-full focus:outline-none ml-2" />
                    </div>
                </div>
                <!-- Champ "Date de départ" -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>📅</span>
                        <input type="date" class="w-full focus:outline-none ml-2" />
                    </div>
                </div>
                <!-- Sélection du nombre de passagers -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>👥</span>
                        <select class="w-full focus:outline-none ml-2 bg-transparent">
                            <option value="1">1 Passager</option>
                            <option value="2">2 Passagers</option>
                            <option value="3">3 Passagers</option>
                            <option value="4">4 Passagers</option>
                            <option value="5">5 Passagers</option>
                            <option value="6">6 Passagers</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Options supplémentaires -->
            <div class="mt-4 flex items-center justify-between">
                <!-- Checkbox aller-retour -->
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="roundTrip" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                    <label for="roundTrip" class="text-sm text-gray-600">Aller-Retour</label>
                </div>
                <!-- Bouton de recherche -->
                <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition flex items-center">
                    🔍 <span class="ml-2">Rechercher</span>
                </button>
            </div>
        </div>
    </div>


    <div class="my-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">

            <div class="pb-4 bg-white dark:bg-gray-900 flex flex-wrap gap-2 justify-between mx-4 mt-3">
                <div class="w-full sm:w-auto">
                    <label for="compagnie-search" class="sr-only">Compagnie</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19L15 15m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="compagnieQuery" placeholder="Compagnie..." type="text" id="compagnie-search" class="block w-full sm:w-40 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                <div class="w-full sm:w-auto">
                    <label for="depart-search" class="sr-only">Départ</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19L15 15m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="departQuery" placeholder="Départ..." type="text" id="depart-search" class="block w-full sm:w-40 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                <div class="w-full sm:w-auto">
                    <label for="arriver-search" class="sr-only">Arrivée</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19L15 15m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input wire:model.live="arriverQuery" placeholder="Arrivée..." type="text" id="arriver-search" class="block w-full sm:w-40 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>
                </div>

                <div class="w-full sm:w-auto">
                    <label for="heure-search" class="sr-only">Heure</label>
                    <div class="relative mt-1">
                        <input wire:model.live="heureQuery" type="time" id="heure-search" class="block w-full sm:w-40 pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 max-w-4xl mx-auto p-4">
                @forelse ($voyages as $voyage)
                    <div  class="max-w-lg mx-auto my-4 shadow-lg rounded-2xl border border-gray-200">
                        <div class="p-4 flex flex-col gap-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $voyage->compagnie->name }}</h3>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <span class="text-sm text-gray-500">{{ now()->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="flex flex-col items-start">
                                    <span class="text-lg font-bold text-gray-800">{{ $voyage->trajet->depart->name }}</span>
                                    <span class="text-sm text-gray-500">Gare : {{ $voyage->trajet->depart->gare }}</span>
                                    <span class="text-sm text-gray-500">Départ : {{ $voyage->heure->format('H:i') }}</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 12l6-6M3 12l6 6" /></svg>
                                <div class="flex flex-col items-end">
                                    <span class="text-lg font-bold text-gray-800">{{ $voyage->trajet->arriver->name }}</span>
                                    <span class="text-sm text-gray-500">Gare : {{ $voyage->trajet->arriver->gare }}</span>
                                    <span class="text-sm text-gray-500">Arrivée estimée : {{ $voyage->heure->addHours(2)->format('H:i') }}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg font-semibold text-gray-800">{{ $voyage->prix }} XOF</span>
                                </div>
                                <a href="{{ route('voyage.show', $voyage) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Sélectionner</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="flex justify-center my-3 text-2xl font-bold" >Aucun Voyages </p>
                @endforelse
            </div>

        </div>
    </div>

</div>
