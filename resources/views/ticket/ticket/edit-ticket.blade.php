@extends('layout')

@section('title','Modifier le ticket')

@section('content')

    <div class="max-w-2xl mx-auto">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-surface-900 dark:text-white">Modifier le Ticket</h1>
            <p class="text-surface-500 dark:text-surface-400 mt-1">Modifiez la date ou l'heure de votre voyage</p>
        </div>

        {{-- Route Info Card (read-only) --}}
        <div class="card mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-surface-100 dark:bg-surface-800 flex items-center justify-center">
                    <svg class="w-5 h-5 text-surface-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" /></svg>
                </div>
                <h3 class="font-semibold text-surface-900 dark:text-white">Trajet</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-surface-400 dark:text-surface-500 mb-1">Ville de départ</p>
                    <p class="font-medium text-surface-900 dark:text-white">{{ $ticket->villeDepart()->name }}</p>
                    <p class="text-sm text-surface-500 dark:text-surface-400">{{ $ticket->gareDepart()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-surface-400 dark:text-surface-500 mb-1">Ville d'arrivée</p>
                    <p class="font-medium text-surface-900 dark:text-white">{{ $ticket->villeArriver()->name }}</p>
                    <p class="text-sm text-surface-500 dark:text-surface-400">{{ $ticket->gareArriver()->name }}</p>
                </div>
            </div>
        </div>

        {{-- Modifier Form --}}
        <div class="card">
            @livewire('ticket.modifier-date-and-heure',['ticket'=>$ticket])
        </div>
    </div>

@endsection
