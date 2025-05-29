@props(['ticket'])
<a href="{{ route('ticket.show-ticket',$ticket) }}" >
    <div
    @class([
        "card m-auto my-4 border-t-4 ",
        "border-red-500 " => $ticket->statut ===\App\Enums\StatutTicket::Bloquer or $ticket->statut ===\App\Enums\StatutTicket::Suspendre,
        "border-yellow-500 " => $ticket->statut ===\App\Enums\StatutTicket::Pause,
        "border-green-500 " => $ticket->statut ===\App\Enums\StatutTicket::Payer,
        "border-blue-500 " => $ticket->statut ===\App\Enums\StatutTicket::EnAttente,
    ])
    >
        <div class=" grid grid-cols-12 items-center  ">
            <div class="w-full border-r-2 border-gray-600 col-span-9 ">
                <div class=" flex gap-2">
                    <img src="{{ asset('icon/12503626.png') }}" class="w-4" alt="">
                    <div>
                        <h5 class=" text-gray-500 capitalize text-sm">{{ $ticket->type }}</h5>
                    </div>
                </div>
                <div>
                    <table class="w-full text-center">
                        <tr>
                            <td>
                                <span class=" text-gray-600 capitalize font-semibold">{{ $ticket->villeDepart()->name }} ({{ $ticket->villeDepart()->region->pays->iso2 }})</span>
                            </td>
                            <td>
                                <span class=" text-sm text-green-500">
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
                                </span>
                            </td>
                            <td>
                                <span class=" text-gray-600 capitalize font-semibold">{{ $ticket->villeArriver()->name }} ({{ $ticket->villeArriver()->region->pays->iso2 }})</span>
                            </td>
                        </tr>
                        <tr >
                            <td  colspan="3">
                                <div class="flex-row justify-center ">
                                    <span class=" text-sm text-gray-600 capitalize font-semibold italic">Le {{ $ticket?->date?->format('d M Y') }} </span>

                                    <span class=" text-sm text-gray-600 capitalize font-semibold italic"> à {{ $ticket?->voyageInstance?->heure?->format('H\h i') }} </span>
                                    <br>
                                    <x-ticket.badge-statut :statut="$ticket->statut"></x-ticket.badge-statut>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class=" w-full pl-2 ">
               <div class=" absolute -top-2  rounded-md -right-3">
                <span @class([
                        "bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400"=> $ticket->statut ===\App\Enums\StatutTicket::Payer,
                        "bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300" => $ticket->statut ===\App\Enums\StatutTicket::Pause,
                        "bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"=> $ticket->statut ===\App\Enums\StatutTicket::Bloquer or $ticket->statut ===\App\Enums\StatutTicket::Suspendre,
                        "bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400"=> $ticket->statut ===\App\Enums\StatutTicket::EnAttente,
                        "bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-purple-400 border border-purple-400"=>$ticket->statut ===\App\Enums\StatutTicket::Valider,
                    ])>
                    {{ $ticket->statut }}
                </span>
               </div>
               <div class="ml-4  flex-row justify-center">
                   <div>
                       Cliquez
                   </div>
                   <div class="ml-3">
                       ici
                   </div>
               </div>
            </div>
        </div>
    </div>
</a>
