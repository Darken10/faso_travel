<div>
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
               placeholder="Rechercher..."
               class="placeholder:text-gray-400 px-3 py-1 rounded-2xl w-56"
        />

        @if(strlen($compagnie) >= 2 )
            <div x-show="open" class="absolute border border-r-gray-100 w-56 mt-1 rounded bg-blue-100">
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
            <div x-show="open" class="absolute border border-r-gray-100 w-56 mt-1 rounded bg-blue-100 max-h-[14rem] overflow-scroll">
                @forelse($departs as $index => $depart)
                    <p  wire:click="clickDepart({{$index}})" class="py-1 px-2 {{ $index === $selectedIndexDepart ? 'text-green-500' : ''  }}">{{ $depart->name  }}</p>
                @empty
                    Aucune Ville
                @endforelse
            </div>
        @endif
    </div>



</div>
