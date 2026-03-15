@extends('layout')

@section('content')

    {{-- Hero Banner --}}
    <div class="relative rounded-2xl overflow-hidden mb-8 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 800 400" fill="none"><circle cx="700" cy="50" r="200" fill="white" fill-opacity="0.1"/><circle cx="100" cy="350" r="150" fill="white" fill-opacity="0.08"/></svg>
        </div>
        <div class="relative px-6 py-10 sm:px-10 sm:py-14 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2">{{ $voyageInstance->compagnie()->name }}</h1>
            <p class="text-primary-200 text-lg">{{ $voyageInstance->compagnie()->slogant }}</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Company description --}}
        @if($voyageInstance->compagnie()->description)
            <div class="card">
                <h2 class="card-header text-surface-900 dark:text-white mb-3">À propos de {{ $voyageInstance->compagnie()->name }}</h2>
                <p class="text-surface-600 dark:text-surface-300 leading-relaxed">{{ $voyageInstance->compagnie()->description }}</p>
            </div>
        @endif

        {{-- Key Info + Inclusions --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Key Info --}}
            <div class="card">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-surface-900 dark:text-white">Informations Clés</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Date de départ</span>
                        <span class="text-sm font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->date->format('D d M Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Durée du trajet</span>
                        <span class="text-sm font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->voyage->temps->format('H\h m\m\i\n') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Prix Aller Simple</span>
                        <span class="text-sm font-bold text-primary-600 dark:text-primary-400">{{ number_format($voyageInstance->prix, 0, ',', ' ') }} XOF</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Prix Aller-Retour</span>
                        <span class="text-sm font-bold text-primary-600 dark:text-primary-400">{{ number_format($voyageInstance->voyage->prix_aller_retour, 0, ',', ' ') }} XOF</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Places disponibles</span>
                        <span class="badge badge-success">{{ $voyageInstance->nb_place_disponible() ?? 'Non défini' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Classe</span>
                        <span class="badge badge-primary">{{ $voyageInstance->classe()->name }}</span>
                    </div>
                </div>
            </div>

            {{-- Inclusions --}}
            <div class="card">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-accent-600 dark:text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-surface-900 dark:text-white">Inclus dans le Voyage</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Gare de départ</span>
                        <span class="text-sm font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->gareDepart()->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Gare d'arrivée</span>
                        <span class="text-sm font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->gareArrive()->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Chauffeur</span>
                        <span class="text-sm font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->chauffer ? $voyageInstance->chauffer?->first_name . ' '. $voyageInstance->chauffer?->last_name : 'Non défini' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-surface-100 dark:border-surface-700">
                        <span class="text-sm text-surface-500 dark:text-surface-400">Véhicule</span>
                        <span class="text-sm font-semibold text-surface-900 dark:text-white">{{ $voyageInstance->care?->immatrculation ?? 'Non défini' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-sm text-surface-500 dark:text-surface-400">État du véhicule</span>
                        <span class="badge badge-neutral">{{ $voyageInstance->care?->etat ?? 'Non défini' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Conforts --}}
        @if($voyageInstance->classe()->conforts && count($voyageInstance->classe()->conforts) > 0)
            <div class="card">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-success-100 dark:bg-success-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" /></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-surface-900 dark:text-white">Le confort du Voyage</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($voyageInstance->classe()->conforts as $confort)
                        <div class="p-4 rounded-xl bg-surface-50 dark:bg-surface-800 border border-surface-100 dark:border-surface-700">
                            <h4 class="font-semibold text-surface-900 dark:text-white mb-1">{{ $confort->title }}</h4>
                            <p class="text-sm text-surface-500 dark:text-surface-400">{{ $confort->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- CTA --}}
        <div class="card bg-gradient-to-r from-primary-600 to-primary-700 border-0 text-center">
            <h2 class="text-2xl font-bold text-white mb-2">Prêt à réserver ?</h2>
            <p class="text-primary-100 mb-6">Achetez votre ticket en quelques clics</p>
            <a href="{{ route('voyage.is_my_ticket', $voyageInstance) }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white text-primary-700 font-semibold rounded-xl hover:bg-primary-50 transition-colors shadow-lg">
                Commencer
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </a>
        </div>
    </div>

@endsection
