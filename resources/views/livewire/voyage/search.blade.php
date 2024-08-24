<div>
    <div>
        <div>
            <input type="text" wire:model="departureCity" placeholder="Ville de départ" />
            @if(!empty($departureSuggestions))
                <ul>
                    @foreach($departureSuggestions as $suggestion)
                        <li wire:click="selectDepartureCity('{{ $suggestion }}')">{{ $suggestion }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    
        <div>
            <input type="text" wire:model="arrivalCity" placeholder="Ville d'arrivée" />
            @if(!empty($arrivalSuggestions))
                <ul>
                    @foreach($arrivalSuggestions as $suggestion)
                        <li wire:click="selectArrivalCity('{{ $suggestion }}')">{{ $suggestion }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    
        <div>
            <input type="date" wire:model="departureTime" placeholder="Date de départ" />
        </div>
    
        <div>
            <input type="text" wire:model="company" placeholder="Compagnie" />
            @if(!empty($companySuggestions))
                <ul>
                    @foreach($companySuggestions as $suggestion)
                        <li wire:click="selectCompany('{{ $suggestion }}')">{{ $suggestion }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    
        <button wire:click="search">Rechercher</button>
    
        @if(!empty($searchResults))
            <h2>Résultats de recherche</h2>
            <ul>
                @foreach($searchResults as $result)
                    <li>{{ $result->trajet->villeDepart->name }} -> {{ $result->trajet->villeArrivee->name }} | {{ $result->heure }} | {{ $result->compagnie_id }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
