@extends("layout")

@section('title','mon ticket')

@section('content')
    <div class="flex justify-center my-4 w-full">
        <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full" src="{{ asset(Auth::user()->profileUrl ?Auth::user()->profileUrl: 'icon/user1.png') }}" alt="User">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $ticket->user->name }}
                        </div>
                        <div class="text-xs font-medium text-gray-600">
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </div>

                    </div>

                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                </div>
            </div>

            <div class=" grid md:grid-cols-12 gap-x-2">
                <div class=" md:col-span-10 mt-2 m-auto tex">
                    <div class=" font-medium text-gray-500 flex gap-x-2 items-center">
                        <div class="mt-2  font-medium text-gray-600">
                            {{ $ticket->voyage->trajet->depart->name ?? "nul part" }} ({{ $ticket->voyage->trajet->depart->region->pays->iso2 ?? "nul part" }})
                            <div class=" text-xs italic text-center">
                                {{ $ticket->voyage->gareDepart->name ?? "nul part" }}
                            </div>
                        </div>
                        <div class="mt-2 text-xs font-medium text-gray-500 ">
                            @if($ticket->type === \App\Enums\TypeTicket::AllerRetour)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            @elseif($ticket->type === \App\Enums\TypeTicket::AllerSimple)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            @endif
                        </div>
                        <div class="mt-2 font-medium text-gray-600">
                            {{ $ticket->voyage->trajet->arriver->name }} ({{ $ticket->voyage->trajet->arriver->region->pays->iso2 }})
                            <div class=" text-xs italic text-center">
                                {{ $ticket->voyage->gareArriver->name }}
                            </div>
                        </div>
                    </div>

                    <div class=" mt-2 text-sm font-medium text-gray-600">
                        Le {{ $ticket->voyage->heure->format('d/m/Y') }} à {{ $ticket->voyage->heure->format('H:i') }}
                    </div>

                        <div class="mt-2 text-sm font-medium    ">
                            Prix :
                            <span class="text-green-600">
                                @if ( $ticket?->payements()->first()?->montant > 0)

                                @else
                                    Gratuit
                                @endif
                            </span>
                        </div>

                </div>
                <div class=" col-span-2 mt-4 flex justify-center">
                    @if($ticket->statut === \App\Enums\StatutTicket::Payer)
                        <div class=" items-center gap-x-2 block">
                            <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($ticket->code_qr_uri)) }}" alt="Code QR">
                            <div class="flex items-center gap-x-2 text-center ">
                                code  : {{ $ticket->code_sms }}
                            </div>
                        </div>
                    @else
                        <div class="items-center gap-x-2 block">
                            <div class="flex items-center gap-x-2 text-center text-red-600 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                                </svg>
                                <span class="">{{ $ticket->statut }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($ticket->statut === \App\Enums\StatutTicket::Payer)
            <div class="flex justify-center my-4 w-full  ">
                <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full ">
                    <div class="flex items-center justify-between text-gray-500 dark:text-gray-400">
                        <div class="flex items-center ">
                            <a href="{{ route('ticket.reenvoyer',$ticket) }}" class="">re-envoyer le PDF par mail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center my-4 w-full  ">
                <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full">
                    <div class="flex items-center justify-between text-gray-500 dark:text-gray-400">
                        <div class="flex items-center ">
                            <a href="{{ route('ticket.regenerer',$ticket) }}" class="">regenerer le ticket</a>
                        </div>
                    </div>
                </div>
            </div>


    @endif



@endsection
