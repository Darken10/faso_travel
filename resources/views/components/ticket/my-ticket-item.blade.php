@props(['ticket'])
<a href="{{ route('ticket.show-ticket',$ticket) }}">
    <div class="card m-auto my-4 ">
        <div class=" grid grid-cols-12 items-center  ">
            <div class="w-full border-r-2 border-gray-600 col-span-9 ">
                <div class=" flex gap-2">
                    <img src="{{ asset('icon/12503626.png') }}" class="w-4">
                    <div>
                        <h5 class=" text-gray-500 capitalize text-sm">{{ $ticket->type }}</h5>
                    </div>
                </div>
                <div>
                    <table class="w-full text-center">
                        <tr >
                            <td>
                                <span class=" text-lg font-bold">{{ $ticket->heureDepart()->format('H:m') }}</span>
                            </td>
                            <td>
                                <span>---------</span>
                            </td>
                            <td>
                                <span class=" text-lg font-bold">{{ $ticket->heureArriver() }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class=" text-gray-600 capitalize font-semibold">{{ $ticket->villeDepart()->name }} ({{ $ticket->villeDepart()->region->pays->iso2 }})</span>
                            </td>
                            <td>
                                <span class=" text-sm text-green-500">Direct</span>
                            </td>
                            <td>
                                <span class=" text-gray-600 capitalize font-semibold">{{ $ticket->villeArriver()->name }} ({{ $ticket->villeArriver()->region->pays->iso2 }})</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class=" text-sm text-gray-600 capitalize font-semibold italic">{{ $ticket->gareDepart()->name }}</span>
                            </td>
                            <td>
                                <span class="  text-green-500"></span>
                            </td>
                            <td>
                                <span class=" text-sm text-gray-600 capitalize font-semibold italic">{{ $ticket->gareArriver()->name }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class=" w-full pl-2 ">
               <div class=" absolute -top-2  rounded-md -right-3">
                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ $ticket->statut }}</span>
               </div>
               <div>
                    <img  src="{{ asset('storage\tickets\qrcode\UZ4soUZ4eU-66e64c40e2d36202409150209.png') }}" alt="" srcset="">
               </div>
            </div>
        </div>
    </div>
</a>
