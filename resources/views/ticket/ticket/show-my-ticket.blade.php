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
                            @if($ticket?->is_my_ticket or $ticket?->transferer_a_user_id=== auth()->user()->id)
                                {{$ticket?->user?->name}}
                            @else
                                {{$ticket?->autre_personne?->name}}
                            @endif

                        </div>
                        <div class="text-xs font-medium text-gray-600 dark:text-gray-400">
                            {{ $ticket->created_at->diffForHumans() }}
                        </div>

                    </div>

                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                        <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownDots" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">

                        @if($ticket?->statut === \App\Enums\StatutTicket::Payer or $ticket?->statut === \App\Enums\StatutTicket::Pause)
                            <li>
                                <a href="{{ route('ticket.editTicket',$ticket) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="flex gap-2">
                                        <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Modifier
                                    </div>
                                </a>
                            </li>
                        @endif

                            @if($ticket?->statut === \App\Enums\StatutTicket::Valider)
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        <div class="flex gap-2">
                                            <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Supprimer
                                        </div>
                                    </a>
                                </li>
                            @endif

                        <li>
                            @if($ticket?->statut === \App\Enums\StatutTicket::Payer)
                                <a href="#" data-modal-target="modal-pause" data-modal-toggle="modal-pause" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="flex gap-2 text-orange-400">
                                        <svg fill="#000000"  height="16px" width="16px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                        <path d="M256,0C114.617,0,0,114.615,0,256s114.617,256,256,256s256-114.615,256-256S397.383,0,256,0z M224,320c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z M352,320 c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z"/>
                                    </svg>
                                        Pause
                                    </div>
                                </a>
                            @elseif($ticket?->statut === \App\Enums\StatutTicket::Pause)
                            <a href="{{ route('ticket.editTicket',$ticket) }}" data-modal-target="popup-modal-ractive" data-modal-toggle="popup-modal-ractive" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                <div class="flex gap-2 text-orange-400">
                                    <svg fill="#000000"  height="16px" width="16px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                        <path d="M256,0C114.617,0,0,114.615,0,256s114.617,256,256,256s256-114.615,256-256S397.383,0,256,0z M224,320c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z M352,320 c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z"/>
                                    </svg>
                                    Reactive
                                </div>
                            </a>
                            @elseif($ticket?->statut === \App\Enums\StatutTicket::Bloquer)
                                <a href="#" data-modal-target="popup-modal-ractive" data-modal-toggle="popup-modal-ractive" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="flex gap-2 text-orange-400">
                                        <svg fill="#000000"  height="16px" width="16px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                            <path d="M256,0C114.617,0,0,114.615,0,256s114.617,256,256,256s256-114.615,256-256S397.383,0,256,0z M224,320c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z M352,320 c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z"/>
                                        </svg>
                                        Debloquer
                                    </div>
                                </a>

                            @elseif($ticket?->statut === \App\Enums\StatutTicket::EnAttente)
                                <a href="
                                        @if(!$ticket?->is_my_ticket and $ticket->autre_personne instanceof \App\Models\Ticket\AutrePersonne)
                                            {{ route('voyage.payerAutrePersonneTicket',$ticket) }}
                                        @else
                                            {{ route('voyage.acheter',$ticket->voyage) }}
                                        @endif
                                        " data-modal-target="popup-modal-ractive" data-modal-toggle="popup-modal-ractive" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="flex gap-2 text-orange-400">
                                        <svg fill="#000000"  height="16px" width="16px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                                <path d="M256,0C114.617,0,0,114.615,0,256s114.617,256,256,256s256-114.615,256-256S397.383,0,256,0z M224,320c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z M352,320 c0,8.836-7.164,16-16,16h-32c-8.836,0-16-7.164-16-16V192c0-8.836,7.164-16,16-16h32c8.836,0,16,7.164,16,16V320z"/>
                                            </svg>
                                        Payer

                                    </div>
                                </a>
                            @endif
                        </li>

                        @if($ticket?->statut === \App\Enums\StatutTicket::Payer or $ticket?->statut === \App\Enums\StatutTicket::Pause)
                            <li>
                                <a href="{{ route('ticket.tranferer-ticket-to-other-user',$ticket) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="flex gap-2">
                                        <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.3085 0.293087C13.699 -0.0976958 14.3322 -0.0976956 14.7227 0.293087L17.7186 3.29095C18.1091 3.68175 18.1091 4.31536 17.7185 4.70613L14.716 7.71034C14.3255 8.10113 13.6923 8.10113 13.3018 7.71034C12.9113 7.31956 12.9113 6.68598 13.3018 6.2952L14.6087 4.98743L7 4.98743C6.44771 4.98743 6 4.53942 6 3.98677C6 3.43412 6.44771 2.98611 7 2.98611L14.5855 2.9861L13.3085 1.70824C12.918 1.31745 12.918 0.683869 13.3085 0.293087Z" fill="#0F0F0F"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 20.998C14.2091 20.998 16 19.206 16 16.9954C16 14.7848 14.2091 12.9927 12 12.9927C9.79086 12.9927 8 14.7848 8 16.9954C8 19.206 9.79086 20.998 12 20.998ZM12 19.0934C10.842 19.0934 9.90331 18.1541 9.90331 16.9954C9.90331 15.8366 10.842 14.8973 12 14.8973C13.158 14.8973 14.0967 15.8366 14.0967 16.9954C14.0967 18.1541 13.158 19.0934 12 19.0934Z" fill="#0F0F0F"/>
                                            <path d="M7 16.9954C7 17.548 6.55229 17.996 6 17.996C5.44772 17.996 5 17.548 5 16.9954C5 16.4427 5.44772 15.9947 6 15.9947C6.55229 15.9947 7 16.4427 7 16.9954Z" fill="#0F0F0F"/>
                                            <path d="M19 16.9954C19 17.548 18.5523 17.996 18 17.996C17.4477 17.996 17 17.548 17 16.9954C17 16.4427 17.4477 15.9947 18 15.9947C18.5523 15.9947 19 16.4427 19 16.9954Z" fill="#0F0F0F"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M21 9.99074C22.6569 9.99074 24 11.3348 24 12.9927V20.998C24 22.656 22.6569 24 21 24H3C1.34315 24 0 22.656 0 20.998V12.9927C0 11.3348 1.34315 9.99074 3 9.99074H21ZM4 11.9921H20C20 12.2549 20.0517 12.5151 20.1522 12.7579C20.2528 13.0007 20.4001 13.2214 20.5858 13.4072C20.7715 13.593 20.992 13.7405 21.2346 13.841C21.4773 13.9416 21.7374 13.9934 22 13.9934V19.9974C21.7374 19.9974 21.4773 20.0491 21.2346 20.1497C20.992 20.2503 20.7715 20.3977 20.5858 20.5835C20.4001 20.7694 20.2528 20.99 20.1522 21.2328C20.0517 21.4756 20 21.7359 20 21.9987H4C4 21.7359 3.94827 21.4756 3.84776 21.2328C3.74725 20.99 3.59993 20.7694 3.41421 20.5835C3.2285 20.3977 3.00802 20.2503 2.76537 20.1497C2.52272 20.0491 2.26264 19.9974 2 19.9974V13.9934C2.26264 13.9934 2.52272 13.9416 2.76537 13.841C3.00802 13.7405 3.2285 13.593 3.41421 13.4072C3.59993 13.2214 3.74725 13.0007 3.84776 12.7579C3.94827 12.5151 4 12.2549 4 11.9921Z" fill="#0F0F0F"/>
                                        </svg>
                                        Transferer
                                    </div>
                                </a>
                            </li>
                        @endif

                    </ul>
                        @if($ticket?->statut === \App\Enums\StatutTicket::Payer)
                        <div class="py-2">
                            <a href="{{ route('ticket.regenerer',$ticket) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                <div class="flex gap-2">
                                    <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.39502 12.0014C4.39544 12.4156 4.73156 12.751 5.14577 12.7506C5.55998 12.7502 5.89544 12.4141 5.89502 11.9999L4.39502 12.0014ZM6.28902 8.1116L6.91916 8.51834L6.91952 8.51777L6.28902 8.1116ZM9.33502 5.5336L9.0396 4.84424L9.03866 4.84464L9.33502 5.5336ZM13.256 5.1336L13.4085 4.39927L13.4062 4.39878L13.256 5.1336ZM16.73 7.0506L16.1901 7.57114L16.1907 7.57175L16.73 7.0506ZM17.7142 10.2078C17.8286 10.6059 18.2441 10.8358 18.6422 10.7214C19.0403 10.607 19.2703 10.1915 19.1558 9.79342L17.7142 10.2078ZM17.7091 9.81196C17.6049 10.2129 17.8455 10.6223 18.2464 10.7265C18.6473 10.8307 19.0567 10.5901 19.1609 10.1892L17.7091 9.81196ZM19.8709 7.45725C19.9751 7.05635 19.7346 6.6469 19.3337 6.54272C18.9328 6.43853 18.5233 6.67906 18.4191 7.07996L19.8709 7.45725ZM18.2353 10.7235C18.6345 10.8338 19.0476 10.5996 19.1579 10.2004C19.2683 9.80111 19.034 9.38802 18.6348 9.2777L18.2353 10.7235ZM15.9858 8.5457C15.5865 8.43537 15.1734 8.66959 15.0631 9.06884C14.9528 9.46809 15.187 9.88119 15.5863 9.99151L15.9858 8.5457ZM19.895 11.9999C19.8946 11.5856 19.5585 11.2502 19.1443 11.2506C18.7301 11.251 18.3946 11.5871 18.395 12.0014L19.895 11.9999ZM18.001 15.8896L17.3709 15.4829L17.3705 15.4834L18.001 15.8896ZM14.955 18.4676L15.2505 19.157L15.2514 19.1566L14.955 18.4676ZM11.034 18.8676L10.8815 19.6019L10.8839 19.6024L11.034 18.8676ZM7.56002 16.9506L8.09997 16.4301L8.09938 16.4295L7.56002 16.9506ZM6.57584 13.7934C6.46141 13.3953 6.04593 13.1654 5.64784 13.2798C5.24974 13.3942 5.01978 13.8097 5.13421 14.2078L6.57584 13.7934ZM6.58091 14.1892C6.6851 13.7884 6.44457 13.3789 6.04367 13.2747C5.64277 13.1705 5.23332 13.4111 5.12914 13.812L6.58091 14.1892ZM4.41914 16.544C4.31495 16.9449 4.55548 17.3543 4.95638 17.4585C5.35727 17.5627 5.76672 17.3221 5.87091 16.9212L4.41914 16.544ZM6.05478 13.2777C5.65553 13.1674 5.24244 13.4016 5.13212 13.8008C5.02179 14.2001 5.25601 14.6132 5.65526 14.7235L6.05478 13.2777ZM8.30426 15.4555C8.70351 15.5658 9.11661 15.3316 9.22693 14.9324C9.33726 14.5331 9.10304 14.12 8.70378 14.0097L8.30426 15.4555ZM5.89502 11.9999C5.89379 10.7649 6.24943 9.55591 6.91916 8.51834L5.65889 7.70487C4.83239 8.98532 4.3935 10.4773 4.39502 12.0014L5.89502 11.9999ZM6.91952 8.51777C7.57513 7.50005 8.51931 6.70094 9.63139 6.22256L9.03866 4.84464C7.65253 5.4409 6.47568 6.43693 5.65852 7.70544L6.91952 8.51777ZM9.63045 6.22297C10.7258 5.75356 11.9383 5.62986 13.1059 5.86842L13.4062 4.39878C11.9392 4.09906 10.4158 4.25448 9.0396 4.84424L9.63045 6.22297ZM13.1035 5.86793C14.2803 6.11232 15.3559 6.7059 16.1901 7.57114L17.27 6.53006C16.2264 5.44761 14.8807 4.70502 13.4085 4.39927L13.1035 5.86793ZM16.1907 7.57175C16.9065 8.31258 17.4296 9.21772 17.7142 10.2078L19.1558 9.79342C18.8035 8.5675 18.1557 7.44675 17.2694 6.52945L16.1907 7.57175ZM19.1609 10.1892L19.8709 7.45725L18.4191 7.07996L17.7091 9.81196L19.1609 10.1892ZM18.6348 9.2777L15.9858 8.5457L15.5863 9.99151L18.2353 10.7235L18.6348 9.2777ZM18.395 12.0014C18.3963 13.2363 18.0406 14.4453 17.3709 15.4829L18.6312 16.2963C19.4577 15.0159 19.8965 13.5239 19.895 11.9999L18.395 12.0014ZM17.3705 15.4834C16.7149 16.5012 15.7707 17.3003 14.6587 17.7786L15.2514 19.1566C16.6375 18.5603 17.8144 17.5643 18.6315 16.2958L17.3705 15.4834ZM14.6596 17.7782C13.5643 18.2476 12.3517 18.3713 11.1842 18.1328L10.8839 19.6024C12.3508 19.9021 13.8743 19.7467 15.2505 19.157L14.6596 17.7782ZM11.1865 18.1333C10.0098 17.8889 8.93411 17.2953 8.09997 16.4301L7.02008 17.4711C8.06363 18.5536 9.40936 19.2962 10.8815 19.6019L11.1865 18.1333ZM8.09938 16.4295C7.38355 15.6886 6.86042 14.7835 6.57584 13.7934L5.13421 14.2078C5.48658 15.4337 6.13433 16.5545 7.02067 17.4718L8.09938 16.4295ZM5.12914 13.812L4.41914 16.544L5.87091 16.9212L6.58091 14.1892L5.12914 13.812ZM5.65526 14.7235L8.30426 15.4555L8.70378 14.0097L6.05478 13.2777L5.65526 14.7235Z"
                                            fill="#000000"/>
                                    </svg>
                                    Regenerer
                                </div>
                            </a>
                        </div>
                        @endif
                </div>


                </div>


            </div>

            <div class=" grid md:grid-cols-12 gap-x-2">


                <x-ticket.info-myticket-aller-retour-date-prix :$ticket />


                <div class=" col-span-2 mt-4 flex justify-center">
                    @if($ticket?->statut === \App\Enums\StatutTicket::Payer)
                        <div class=" items-center gap-x-2 block">
                            <img src="{{ asset(\Illuminate\Support\Facades\Storage::url($ticket?->code_qr_uri)) }}" alt="Code QR">
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
                                <span class="">{{ $ticket?->statut }}</span>
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
                            <a href="{{ route('ticket.reenvoyer',$ticket) }}" class="">Re-Envoyer le PDF par mail</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center my-4 w-full  ">
                <div class="max-w-lg p-6 bg-white rounded-lg shadow-md w-full dark:text-gray-200 dark:bg-gray-800">
                    <div class="flex items-center justify-between text-gray-500 dark:text-gray-300">
                        <div class="flex items-center ">
                            <a href="{{ route('ticket.regenerer',$ticket) }}" class="">Regenerer le ticket</a>
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




    {{-- debut modal de mise en pause --}}
    <div id="modal-pause" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-pause">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Êtes-vous sûr de vouloir mettre votre ticket en pause ?</h3>
                    <form action="{{ route('ticket.mettre-en-pause',$ticket) }}" method="post">
                        @csrf
                        <button data-modal-hide="modal-pause" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Oui
                        </button>
                        <button data-modal-hide="modal-pause" type="reset" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Non, Annuller
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    {{-- fin modal de mise en pause --}}

@endsection

@section('script')

    <script src="{{ asset('js/flowbite.min.js') }}"></script>
@endsection
