@extends('layout')

@section('title', 'Acheter un ticket')

@section('content')

    <div class="max-w-2xl mx-auto">
        {{-- Hero header --}}
        <div class="relative overflow-hidden rounded-2xl mb-6 bg-gradient-to-br from-primary-600 via-primary-500 to-accent-500 shadow-elevated">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 400 200" fill="none"><circle cx="350" cy="50" r="120" fill="white"/><circle cx="50" cy="180" r="80" fill="white"/></svg>
            </div>
            <div class="relative p-6 sm:p-8 text-white">
                <div class="flex items-center gap-4 mb-4">
                    @if($voyageInstance->compagnie()->logo ?? false)
                        <img src="{{ asset($voyageInstance->compagnie()->logo) }}" alt="" class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm p-1 object-contain" />
                    @else
                        <div class="w-14 h-14 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                        </div>
                    @endif
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold">{{ $voyageInstance->compagnie()->name }}</h1>
                        <p class="text-white/70 text-sm italic">{{ $voyageInstance->compagnie()->slogant }}</p>
                    </div>
                </div>

                {{-- Route info --}}
                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm rounded-xl p-4">
                    <div class="text-center flex-1">
                        <p class="text-xs text-white/70 uppercase tracking-wider">Départ</p>
                        <p class="font-bold text-lg">{{ $voyageInstance->voyage->trajet->depart->name ?? 'N/A' }}</p>
                        <p class="text-xs text-white/60">{{ $voyageInstance->gareDepart()->name ?? '' }}</p>
                    </div>
                    <div class="flex flex-col items-center gap-1 px-2">
                        <svg class="w-5 h-5 text-white/60" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                        <span class="text-[10px] text-white/50">{{ $voyageInstance->voyage->temps?->format('H\\h i') ?? '' }}</span>
                    </div>
                    <div class="text-center flex-1">
                        <p class="text-xs text-white/70 uppercase tracking-wider">Arrivée</p>
                        <p class="font-bold text-lg">{{ $voyageInstance->voyage->trajet->arriver->name ?? 'N/A' }}</p>
                        <p class="text-xs text-white/60">{{ $voyageInstance->gareArrive()->name ?? '' }}</p>
                    </div>
                </div>

                {{-- Meta info --}}
                <div class="flex flex-wrap gap-3 mt-4">
                    <span class="inline-flex items-center gap-1.5 text-xs bg-white/15 backdrop-blur-sm rounded-lg px-3 py-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                        {{ $voyageInstance->date?->format('d M Y') }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs bg-white/15 backdrop-blur-sm rounded-lg px-3 py-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ $voyageInstance->heure?->format('H\\h i') }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-xs bg-white/15 backdrop-blur-sm rounded-lg px-3 py-1.5 font-bold">
                        {{ $voyageInstance->prix }} XOF
                    </span>
                </div>
            </div>
        </div>

        {{-- Purchase form --}}
        @livewire("voyage-instance.info-supplementaire-pour-achat-ticket",['voyageInstance'=>$voyageInstance])
    </div>

@endsection
