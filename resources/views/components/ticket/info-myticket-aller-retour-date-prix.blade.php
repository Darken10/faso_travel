@props(['ticket'=>null, 'with_statut'=>false])

<div class=" md:col-span-10 mt-2 m-auto dark:text-gray-300">

    <div class=" text-gray-800 flex gap-x-2 items-center dark:text-gray-300 justify-center font-bold">
        {{ $ticket->compagnie()->name }}
    </div>
    <div class=" font-medium text-gray-800 flex gap-x-2 items-center dark:text-gray-300">
        <div class="mt-2  font-medium text-gray-800 dark:text-gray-300">
            {{ $ticket?->voyageInstance?->villeDepart()?->name ?? "Nul Part" }} ({{ $ticket?->voyageInstance?->villeDepart()?->region?->pays->iso2 ?? "Nul Part" }})
            <div class=" text-xs italic text-center">
                {{ $ticket?->voyageInstance?->gareDepart()?->name ?? "Nul Part" }}
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
            {{ $ticket?->voyageInstance?->villeArrive()?->name}} ({{ $ticket?->voyageInstance?->villeDepart()?->region?->pays->iso2 }})
            <div class=" text-xs italic text-center">
                {{ $ticket?->voyageInstance?->gareArrive()?->name }}
            </div>
        </div>
    </div>

    <div class=" mt-2 text-sm font-medium text-gray-800 dark:text-gray-300 flex justify-center">
        Le {{ $ticket?->voyageInstance?->date?->format('d M Y') }} à {{ $ticket?->voyageInstance?->heure?->format('H\h i') }}
    </div>

    <div class=" md:flex md:justify-between text-gray-800">
        <div class="mt-2 text-sm font-medium  flex justify-center ">
            Classe :
            <span class="font-semibold px-2">
            {{ $ticket?->voyageInstance?->classe()?->name ?? $ticket?->voyageInstance?->voyage?->classe->name }}
            </span>
        </div>
        <div class="mt-2 text-sm font-medium flex justify-center ">
            Siège N° {{ $ticket->numero_chaise ?? "Non défini"}}
        </div>
    </div>

    <div class=" md:flex md:justify-between text-gray-800">
        <div class="mt-2 text-sm font-medium   flex justify-center ">
            Prix :
            <span class="text-green-600 font-semibold px-2">
                @if ( $ticket?->payements()->first()?->montant > 0)
                   {{ $ticket?->payements()->first()?->montant  }} F CFA
                @elseif ( $ticket->statut === \App\Enums\StatutTicket::EnAttente)
                    {{ $ticket->prix() }} F CFA
                @else
                    Gratuit
                @endif
            </span>
        </div>
        <div class="mt-2 text-sm font-medium  flex justify-center ">

            @if($ticket?->voyageInstance?->statut ===\App\Enums\StatutVoyageInstance::DISPONIBLE)
                <span
                    @class([
    "bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400"=> $ticket->statut ===\App\Enums\StatutTicket::Payer,
    "bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300" => $ticket->statut ===\App\Enums\StatutTicket::Pause,
    "bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"=> $ticket->statut ===\App\Enums\StatutTicket::Bloquer or $ticket->statut ===\App\Enums\StatutTicket::Suspendre,
    "bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400"=> $ticket->statut ===\App\Enums\StatutTicket::EnAttente,
                        "bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-purple-400 border border-purple-400"=>$ticket->statut ===\App\Enums\StatutTicket::Valider,
])
                >
                    Statut :
                    {{ $ticket->statut }}
                </span>

            @else
                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                    Le voyage a été annulé
                </span>
            @endif

        </div>

    </div>


    @if($with_statut)
        <div class=" mt-2 flex justify-center">
            <x-ticket.badge-statut :statut="$ticket->statut" />
        </div>
    @endif

</div>
