@extends("layout")

@section('title','mon ticket')

@section('content')
    <div class="flex justify-center my-4 w-full ">
        <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between ">
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full " src="{{ asset(Auth::user()->profileUrl ?Auth::user()->profileUrl: 'icon/user1.png') }}" alt="User">
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $ticket->user->name }}
                        </div>
                        <div class="text-xs font-medium text-gray-600 dark:text-gray-400">
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

                <x-ticket.info-myticket-aller-retour-date-prix :$ticket />

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
                <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full dark:text-gray-200 dark:bg-gray-800">
                    <div class="flex items-center justify-between text-gray-500 dark:text-gray-200 dark:bg-gray-800">
                        <div class="flex items-center ">
                            <a href="{{ route('ticket.reenvoyer',$ticket) }}" class="">re-envoyer le PDF par mail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center my-4 w-full  ">
                <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full dark:text-gray-200 dark:bg-gray-800">
                    <div class="flex items-center justify-between text-gray-500 dark:text-gray-300">
                        <div class="flex items-center ">
                            <a href="{{ route('ticket.regenerer',$ticket) }}" class="">regenerer le ticket</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center my-4 w-full  ">
                <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full dark:text-gray-200 dark:bg-gray-800">
                    <div class="flex items-center justify-between text-gray-500 dark:text-gray-300">
                        <div class="flex items-center ">
                            <a href="{{ route('ticket.tranferer-ticket-to-other-user',$ticket) }}" class="">Transferer a un autre utilisateur</a>
                        </div>
                    </div>
                </div>
            </div>
    @endif






@endsection
