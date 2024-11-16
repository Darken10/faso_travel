@extends('layout')

@section('content')

<div class=" flex justify-center my-4">
    <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="#"  class="w-full">
            <img class="rounded-t-lg" style="width: 100%" src="{{ asset('images/tk2.jpg') }}" alt="" />
        </a>
        <div class="p-5">
            <a href="#" class=" flex justify-center mx-3 mt-4">
                <div class="block">
                    <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $voyage->compagnie->name }}</h5>
                    <p class="mb-3 font-normal text-gray-400 dark:text-gray-400 flex justify-center italic text-sm " >'{{ $voyage->compagnie->slogant }}</p>
                </div>
            </a>

            <div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm italic">{{ \Str::limit($voyage->compagnie->description,150) }}</p>
            </div>

            <div class="mb-4">
                <div class=" flex justify-between my-2">
                    <div class="">
                        <div class=" text-green-600">Ville de Depart </div>
                        <div>{{ $voyage->trajet->depart->name }}</div>
                    </div>
                    <div class="">
                        <div class=" text-green-600">Ville d'Arriver </div>
                        <div>{{ $voyage->trajet->arriver->name }}</div>
                    </div>
                </div>

                <div class=" flex justify-between my-2">
                    <div class="">
                        <div class=" text-green-600">Gare Depart </div>
                        <div>{{ $voyage->gareDepart->name }}</div>
                    </div>
                    <div class="">
                        <div class=" text-green-600">Gare d'Arriver </div>
                        <div>{{ $voyage->gareArrive->name }}</div>
                    </div>
                </div>

                <div class=" flex justify-between my-2">
                    <div class="">
                        <div class=" text-green-600">Date Depart </div>
                        <div>{{ $voyage->heure->format('j/m/Y') }}</div>
                    </div>
                    <div class="">
                        <div class=" text-green-600">Date d'Arriver </div>
                        <div>{{ $voyage->heure->format('j/m/Y') }}</div>
                    </div>
                </div>

                <div class=" flex justify-between my-2">
                    <div class="">
                        <div class=" text-green-600">Heure Depart </div>
                        <div>{{ $voyage->heure->format('h \h i\m\n') }}</div>
                    </div>
                    <div class="">
                        <div class=" text-green-600">Heure d'Arriver </div>
                        <div>{{ $voyage->heure->format('h \h i\m\n') }}</div>
                    </div>
                </div>

                <div class=" flex justify-between my-2">
                    <div class="">
                        <div class=" text-green-600">Prix </div>
                        <div>{{ $voyage->prix }} XOF</div>
                    </div>
                    <div class="">
                        <div class=" text-green-600">Classe</div>
                        <div>{{ $voyage->classe->name }}</div>
                    </div>
                </div>
                <ul>
                    @forelse($voyage->classe->conforts as $confort)

                        <div class=" flex justify-between my-2">
                            <div class="">
                                <div class=" flex gap-3">
                                    <img src="{{ asset('images/idee.png') }}" class="w-8" alt="" srcset="">
                                    <span>{{ $confort->title }}</span>
                                </div>
                                <div class="text-xs">{{ $confort->description }}</div>
                            </div>
                        </div>
                    @empty
                </ul>
                    Pas de Conforts

                @endforelse
            </div>

            <div class="flex justify-end">
                <a href="{{ route('voyage.is_my_ticket',$voyage) }}" class="inline-flex  items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Suivant
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
