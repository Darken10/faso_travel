@extends('layout')

@section('title','Mes Tickets')

@section('content')

    {{-- Page Header --}}
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-surface-900 dark:text-white">Mes Tickets</h1>
                <p class="text-surface-500 dark:text-surface-400 mt-1">Retrouvez tous vos tickets de voyage</p>
            </div>
            <a href="{{ route('voyage.index') }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Nouveau voyage
            </a>
        </div>
    </div>

    @if(count($tickets) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($tickets as $ticket)
                <x-ticket.my-ticket-item :$ticket />
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="card text-center py-16">
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-surface-100 dark:bg-surface-800 flex items-center justify-center">
                <svg class="w-10 h-10 text-surface-400 dark:text-surface-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-surface-900 dark:text-white mb-2">Aucun ticket</h3>
            <p class="text-surface-500 dark:text-surface-400 mb-6 max-w-sm mx-auto">Vous n'avez pas encore de ticket. Explorez les voyages disponibles pour réserver.</p>
            <a href="{{ route('voyage.index') }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                Rechercher un voyage
            </a>
        </div>
    @endif

@endsection
