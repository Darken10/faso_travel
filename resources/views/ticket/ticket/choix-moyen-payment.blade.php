@extends('layout')

@section('title','Paiement')

@section('content')

    <div class="max-w-lg mx-auto">
        {{-- Success indicator --}}
        <div class="text-center mb-6">
            <div class="w-16 h-16 rounded-full bg-success-100 dark:bg-success-500/20 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-success-600 dark:text-success-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-surface-900 dark:text-white">Ticket réservé !</h1>
            <p class="text-surface-500 dark:text-surface-400 mt-1">Choisissez votre moyen de paiement pour finaliser</p>
        </div>

        {{-- Payment methods --}}
        <div class="card">
            <h2 class="text-sm font-semibold text-surface-500 dark:text-surface-400 uppercase tracking-wider mb-4">Moyens de paiement</h2>
            @livewire('ticket.choix-moyen-payement', ['ticket' => $ticket], key(1))
        </div>

        {{-- Security note --}}
        <div class="flex items-center justify-center gap-2 mt-4 text-xs text-surface-400 dark:text-surface-500">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
            </svg>
            Paiement sécurisé — Vos données sont protégées
        </div>
    </div>

@endsection
