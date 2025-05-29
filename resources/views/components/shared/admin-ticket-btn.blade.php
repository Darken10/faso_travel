@props(['ticket'])
    <div class="inline-flex items-center rounded-md shadow-sm">
        <button id="btn-valider-{{ $ticket->id }}"  data-modal-target="authentication-modal-{{ $ticket->id }}" data-modal-toggle="authentication-modal-{{ $ticket->id }}" type="button" class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border border-slate-200 rounded-l-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </svg>
              </span>
        </button>
        <button  class="text-slate-800 hover:text-blue-600 text-sm bg-white hover:bg-slate-100 border-y border-slate-200 font-medium px-4 py-2 inline-flex space-x-1 items-center">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
        </button>

        <button data-modal-target="popup-modal{{ $ticket->id }}" data-modal-toggle="popup-modal{{ $ticket->id }}" type="button" class="text-red-600 hover:text-red-800 text-sm bg-white hover:bg-red-200 border border-slate-200 rounded-r-lg font-medium px-4 py-2 inline-flex space-x-1 items-center">
            <span >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
              </svg>
            </span>
        </button>
    </div>



    <!-- Modal Valider le Ticket -->
    <div id="authentication-modal-{{ $ticket->id }}" tabindex="-1" aria-hidden="true" class="shadow-2xl hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex bg-green-400 items-center justify-between p-4 md:p-5 border-b rounded-t-lg dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-white dark:text-white">
                        Vérification du Ticket
                    </h3>
                    <button type="button" class="end-2.5 text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal-{{ $ticket->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                           <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form method="POST" class="space-y-4" action="{{ route('admin.ticket-validation.valider',$ticket) }}">
                        @csrf
                        <div>
                            <label for="numero" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numéro de téléphone</label>
                            <input type="tel" name="numero" id="numero" placeholder="70 70 70 70" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  required />
                        </div>
                        <div>
                            <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code de vérification</label>
                            <input type="tel" name="code" id="code" placeholder="123456" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                        </div>


                        <button type="reset" class="w-1/2 text-white bg-red-700 hover:bg-red-800 font-semibold rounded-lg text-sm px-5 py-2.5 text-center">Annuler</button>
                        <button type="submit" class="w-1/2 text-white bg-blue-700 hover:bg-blue-800 font-semibold rounded-lg text-sm px-5 py-2.5 text-center">Valider</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal suspendre le Ticket -->
    <div id="popup-modal{{ $ticket->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <div class="flex bg-red-500  items-center justify-between p-4 md:p-5 border-b rounded-t-lg dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-100 dark:text-white">
                        Suspendre un Ticket
                    </h3>
                    <button type="button" class="text-gray-100 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal{{ $ticket->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Êtes-vous sûr de vouloir<br>suspendre ce ticket ?</h3>

                    <form action="{{ route('admin.ticket-validation.suspendre',$ticket) }}" method="post" class=" flex justify-between ">
                        @csrf
                        {{-- <x-admin.btn-danger data-modal-hide="popup-modal{{ $ticket->id }}" type="submit" >
                            Suspendre
                        </x-admin.btn-danger>
                        <x-admin.btn-default data-modal-hide="popup-modal{{ $ticket->id }}" type="reset" >
                            Annuler
                        </x-admin.btn-default> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>




{{-- Asombrire le back --}}
<script src="{{ asset('node_modules/flowbite/flowbite.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script>
    Asombrire('popup-modal{{ $ticket->id }}')
</script>
