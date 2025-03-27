@extends('layout')

@section('content')

    <!-- Section Header -->
    <header class="relative ">
        <img class="w-full h-80 object-cover" src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Destination du Voyage">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white drop-shadow-lg">{{$voyageInstance->compagnie()->name}}</h1>
            <p class="text-lg md:text-2xl text-white mt-4 drop-shadow-lg">{{$voyageInstance->compagnie()->slogant}}</p>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <!-- Aperçu du Voyage -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{$voyageInstance->compagnie()->name}}</h2>
            <p class="text-gray-700 leading-relaxed">
                {{ $voyageInstance->compagnie()->description }}
            </p>
        </section>

        <!-- Informations Clés et Inclusions -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Informations Clés -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Informations Clés</h3>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Date de départ :</strong> {{$voyageInstance->date->format('D d M y')}}</li>
                    <li><strong>Durée :</strong> {{$voyageInstance->voyage->temps->format('H\h m')}}</li>
                    <li><strong>Prix Aller Simple:</strong> {{$voyageInstance->prix}} XOF par personne</li>
                    <li><strong>Prix Aller-Retour:</strong> {{ $voyageInstance->voyage->prix_aller_retour }} XOF par personne</li>
                    <li><strong>Places disponibles :</strong> {{$voyageInstance->nb_place_disponible() ?? "Non Definie"}}</li>
                    <li><strong>Classe :</strong> {{$voyageInstance->classe()->name}}</li>
                </ul>
            </div>
            <!-- Inclusions du Voyage -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-indigo-600 mb-4">Inclus dans le Voyage</h3>
                <ul class="space-y-2 text-gray-700">
                    <li><strong>Gare de Depart :</strong> {{$voyageInstance->gareDepart()->name}}</li>
                    <li><strong>Gare de Destination :</strong> {{$voyageInstance->gareArrive()->name}}</li>
                    <li><strong>Chauffeur :</strong> {{$voyageInstance->chauffer ? $voyageInstance->chauffer?->first_name . ' '. $voyageInstance->chauffer?->last_name : "Non Definie"}} </li>
                    <li><strong>Care :</strong> {{ $voyageInstance->care?->immatrculation ?? "Non Definie" }} </li>
                    <li><strong>Etat du Care :</strong> {{ $voyageInstance->care?->etat ?? "Non Definie" }} </li>
                </ul>
            </div>
        </section>

        <!-- Itinéraire -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Le confort du Voyage</h2>
            <div class="space-y-4">

               @foreach($voyageInstance->classe()->conforts as $confort)
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold text-indigo-600">{{$confort->title}}</h4>
                        <p class="text-gray-700">{{$confort->description}}</p>
                    </div>

               @endforeach
            </div>
        </section>

        <!-- Informations Supplémentaires -->
        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Informations Supplémentaires</h2>
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-700">
                    Pour toute question ou demande particulière, n'hésitez pas à nous contacter. Nous sommes à votre disposition pour adapter ce voyage à vos envies et besoins spécifiques.
                </p>
            </div>
        </section>

        <!-- Section Réservation -->
        <section class="bg-indigo-600 p-6 rounded-lg shadow text-white text-center">
            <h2 class="text-2xl font-bold mb-4">Payer un Ticket</h2>
            <a href="{{route('voyage.is_my_ticket',$voyageInstance)}}" class="bg-white text-indigo-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Commencer la reservation</a>
        </section>
    </main>


  {{--  <div class=" flex justify-center my-4">
        <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#"  class="w-full">
                <img class="rounded-t-lg" style="width: 100%" src="{{ asset('images/tk2.jpg') }}" alt="" />
            </a>
            <div class="p-5">
                <a href="#" class=" flex justify-center mx-3 mt-4">
                    <div class="block">
                        <h5 class=" text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $voyageInstance->compagnie()->name }}</h5>
                        <p class="mb-3 font-normal text-gray-400 dark:text-gray-400 flex justify-center italic text-sm " >'{{ $voyageInstance->compagnie()->slogant }}</p>
                    </div>
                </a>

                <div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm italic">{{ \Str::limit($voyageInstance->compagnie()->description,150) }}</p>
                </div>

                <div class="mb-4">
                    <div class=" flex justify-between my-2">
                        <div class="">
                            <div class=" text-green-600">Ville de Depart </div>
                            <div>{{ $voyageInstance->villeDepart()->name }}</div>
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

                    <x-accordion :conforts="$voyage->classe->conforts"></x-accordion>
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
    </div>--}}

@endsection
