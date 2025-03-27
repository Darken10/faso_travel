<div>
    <!-- Section Hero -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Titre et description -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Payez vos tickets de voyage en toute confiance</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Trouvez les meilleures offres sur les voyages, Votre voyage confortable commence ici.</p>
        </div>

        <!-- Formulaire de recherche -->
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-4xl mx-auto">
            <!-- Boutons de sélection du transport -->
            <div class="flex space-x-4 mb-6 overflow-x-auto pb-2">
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg transition bg-indigo-100 text-indigo-700 hover:bg-gray-100">
                    <span>🚌</span>
                    <span>Car</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg transition hover:bg-gray-100">
                    <span>🚆</span>
                    <span>Train</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 rounded-lg transition hover:bg-gray-100">
                    <span>🚌</span>
                    <span>Vol</span>
                </button>
            </div>

            <!-- Champs de saisie -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Champ "From" -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="De" class="w-full focus:outline-none ml-2 border-none focus:border-none" />
                    </div>
                </div>
                <!-- Champ "To" -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </span>
                        <input type="text" placeholder="À" class="w-full focus:outline-none ml-2 border-none focus:border-none" />
                    </div>
                </div>
                <!-- Champ "Date de départ" -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </span>
                        <input type="date" class="w-full focus:outline-none ml-2 border-none focus:border-none" />
                    </div>
                </div>
                <!-- Sélection du nombre de passagers -->
                <div class="relative">
                    <div class="flex items-center border rounded-lg p-3 hover:border-indigo-500 bg-white">
                        <span>👥</span>
                        <select class="w-full focus:outline-none ml-2 bg-transparent border-none focus:border-none">
                            @foreach($allCompagnies as  $compagnie)
                                <option value="{{$compagnie->id}}">{{$compagnie->name}}</option>
                            @endforeach
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
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <span class="ml-2">Rechercher</span>
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 max-w-6xl mx-auto p-4">
        @forelse ($voyageInstances as $voyageInstance)
            <div  class="max-w-xl w-full mx-auto my-4 shadow-lg rounded-2xl border border-gray-200">
                <div class="p-4 flex flex-col gap-4 bg-white rounded-2xl">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $voyageInstance->voyage->compagnie->name }}</h3>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span class="text-sm text-gray-500">{{ $voyageInstance->date->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex flex-col items-start">
                            <span class="text-lg font-bold text-gray-800">{{ $voyageInstance->villeDepart()->name }}</span>
                            <span class="text-sm text-gray-500">Gare : {{ $voyageInstance->gareDepart()->name }}</span>
                            <span class="text-sm text-gray-500">Départ : {{ $voyageInstance->heure->format('H:i') }}</span>
                        </div>
                        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>

                        <div class="flex flex-col items-end">
                            <span class="text-lg font-bold text-gray-800">{{ $voyageInstance->villeArrive()->name }}</span>
                            <span class="text-sm text-gray-500">Gare : {{ $voyageInstance->gareArrive()->gare }}</span>
                            <span class="text-sm text-gray-500">Arrivée estimée : {{ $voyageInstance->heure->addHours(2)->format('H:i') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-semibold text-gray-800">{{ $voyageInstance->prix }} XOF</span>
                        </div>
                        <a href="{{ route('voyage.instance.show', $voyageInstance->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Sélectionner</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="flex justify-center my-3 text-2xl font-bold" >Aucun Voyages </p>
        @endforelse
    </div>




</div>
