@extends('layout')

@section('title','Confirmer le transfert')

@section('content')
<div class="max-w-lg mx-auto">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-surface-900 dark:text-white">Confirmer le transfert</h1>
        <p class="text-surface-500 dark:text-surface-400 mt-1">Vérifiez le destinataire puis validez avec votre mot de passe</p>
    </div>

    {{-- User Card --}}
    <div class="card mb-4">
        <div class="flex items-center gap-4">
            <img class="w-16 h-16 rounded-2xl object-cover shadow-soft" src="{{ asset($user->profileUrl ?? 'icon/user1.png') }}" alt="">
            <div>
                <h2 class="text-lg font-semibold text-surface-900 dark:text-white">{{ $user->name }}</h2>
                <p class="text-sm text-surface-500 dark:text-surface-400">{{ $user->sexe }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('ticket.tranferer-ticket-to-other-user', $ticket) }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Choisir un autre utilisateur
            </a>
        </div>
    </div>

    {{-- Password Form --}}
    <div class="card">
        <form method="POST" action="{{ route('ticket.tranferer-ticket-traitement', $ticket) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="mb-4">
                <label for="password" class="input-label">Mot de passe</label>
                <input name="password" id="password" type="password" class="input w-full" placeholder="Entrez votre mot de passe" required>
            </div>

            <div class="flex items-start gap-2 mb-6">
                <input id="accepted" type="checkbox" name="accepted" class="mt-1 w-4 h-4 rounded border-surface-300 dark:border-surface-600 text-primary-600 focus:ring-primary-500" required>
                <label for="accepted" class="text-sm text-surface-600 dark:text-surface-300">
                    J'accepte les <a href="{{ route('divers.termes-et-conditions') }}" class="text-primary-600 dark:text-primary-400 hover:underline">conditions de transfert</a>.
                </label>
            </div>

            <button type="submit" class="btn-primary w-full flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>
                Valider le transfert
            </button>
        </form>
    </div>
</div>
@endsection
