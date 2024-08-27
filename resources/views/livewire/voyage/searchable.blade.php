<div>
    <div class="flex gap-3">
        {{-- ====== Compagnie ============================================================== --}}
        <div x-data="{ open: true }">
            <input @click.outside=" open = false; @this.resetIndex();"
                @click="open = true"
                type="text"
                wire:model.live="compagnie"
                wire:keydown.arrow-down.prevent="incrementIndex"
                wire:keydown.arrow-up.prevent="decrementIndex"
                wire:keydown.backspace="resetIndex"
                wire:keydown.enter.prevent="clickEnter"
                @keyup.enter="open = false"
                placeholder="Compagnie..."
                class="placeholder:text-gray-400 px-3 py-1 rounded-2xl w-56"
            />
            @if(strlen($compagnie) >= 2 )
                <div x-show="open" class="absolute border border-r-gray-100 w-56 mt-1 rounded bg-blue-100 z-50">
                    @forelse($compagnies as $index => $compagnie)
                        <p wire:click="clickCompagnie({{$index}})" class="py-1 px-2 {{ $index === $selectedIndex ? 'text-green-500' : ''  }}">{{ $compagnie->name  }}</p>
                    @empty
                        Aucune Compagnie
                    @endforelse
                </div>
            @endif
        </div>

        {{-- ====== Ville Depart ============================================================== --}}
        <div x-data="{ open: true }">
            <input @click.outside="open = false; @this.resetIndexDepart();"
                @click="open = true"
                type="text"
                wire:model.live="depart"
                wire:keydown.arrow-down.prevent="incrementIndexDepart"
                wire:keydown.arrow-up.prevent="decrementIndexDepart"
                wire:keydown.backspace="resetIndexDepart"
                wire:keydown.enter.prevent="clickEnterDepart"
                @keyup.enter="open = false"
                placeholder="Depart..."
                class="placeholder:text-gray-400 px-3 py-1 rounded-2xl w-56"
            />

            @if(strlen($depart) >= 2 )
                <div x-show="open" class="absolute border border-r-gray-100 w-56 mt-1 rounded bg-blue-100 max-h-[14rem] overflow-scroll z-50">
                    @forelse($departs as $index => $depart)
                        <p  wire:click="clickDepart({{$index}})" class="py-1 px-2 {{ $index === $selectedIndexDepart ? 'text-green-500' : ''  }}">{{ $depart->name  }}</p>
                    @empty
                        Aucune Ville
                    @endforelse
                </div>
            @endif
        </div>

    </div>


    <div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white dark:bg-gray-900">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                </div>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($voyages as $voyage)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
                                {{ $voyage->heure }}
                            </td>
                            <td class="px-6 py-4">
                                {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                                {{ $voyage->prix }} XOF
                            </td>
                        </tr>
                    @empty
                        <p>Aucune donnes</p>
                    @endforelse
                </tbody>
            </table>
        </div>


        
    </div>

</div>
