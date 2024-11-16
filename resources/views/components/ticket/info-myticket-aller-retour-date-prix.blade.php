@props(['ticket'=>null, 'with_statut'=>false])

<div class=" md:col-span-10 mt-2 m-auto dark:text-gray-300">
    <div class=" font-medium text-gray-800 flex gap-x-2 items-center dark:text-gray-300">
        <div class="mt-2  font-medium text-gray-800 dark:text-gray-300">
            {{ $ticket?->voyage?->trajet?->depart->name ?? "Nul Part" }} ({{ $ticket?->voyage?->trajet?->depart?->region?->pays->iso2 ?? "Nul Part" }})
            <div class=" text-xs italic text-center">
                {{ $ticket?->voyage?->gareDepart?->name ?? "Nul Part" }}
            </div>
        </div>
        <div class="mt-2 text-xs font-medium text-gray-800 dark:text-gray-300">
            @if($ticket?->type === \App\Enums\TypeTicket::AllerRetour)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                </svg>
            @elseif($ticket?->type === \App\Enums\TypeTicket::AllerSimple)
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            @endif
        </div>
        <div class="mt-2 font-medium text-gray-700 dark:text-gray-300">
            {{ $ticket?->voyage?->trajet?->arriver->name }} ({{ $ticket?->voyage?->trajet?->arriver?->region?->pays->iso2 }})
            <div class=" text-xs italic text-center">
                {{ $ticket?->voyage?->gareArriver?->name }}
            </div>
        </div>
    </div>

    <div class=" mt-2 text-sm font-medium text-gray-700 dark:text-gray-300 flex justify-center">
        Le {{ $ticket?->date?->format('d M Y') }} à {{ $ticket?->voyage?->heure?->format('H\h i') }}
    </div>

    <div class="mt-2 text-sm font-medium  flex justify-center  ">
        Prix :
        <span class="text-green-600 font-semibold px-2">
            @if ( $ticket?->payements()->first()?->montant > 0)
                {{ $ticket?->payements()->first()?->montant }} F CFA
            @else
                Gratuit
            @endif
        </span>
    </div>
    @if($with_statut)
        <div class=" mt-2 flex justify-center">
            <x-ticket.badge-statut :statut="$ticket->statut" />
        </div>
    @endif

</div>
