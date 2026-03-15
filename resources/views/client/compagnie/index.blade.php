@extends('layout')

@section('title','Compagnies partenaires')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-50 dark:bg-primary-900/20 rounded-full mb-3">
            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Transport</span>
        </div>
        <h1 class="text-3xl font-bold text-surface-900 dark:text-white mb-2">Nos compagnies partenaires</h1>
        <p class="text-surface-500 dark:text-surface-400">Découvrez les compagnies de transport disponibles sur notre plateforme</p>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @foreach ($compagnies as $compagnie)
            <a href="{{ route('client.compagnie.show', $compagnie) }}" class="card group hover:shadow-elevated transition-all duration-300 hover:-translate-y-1">
                <div class="flex items-center justify-center h-28 bg-surface-50 dark:bg-surface-800 rounded-xl mb-4">
                    @if($compagnie->logo)
                        <img src="{{ asset('storage/' . $compagnie->logo) }}" alt="{{ $compagnie->name }}" class="h-20 object-contain">
                    @else
                        <div class="w-14 h-14 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <svg class="w-7 h-7 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                        </div>
                    @endif
                </div>
                <h2 class="text-lg font-semibold text-surface-900 dark:text-white mb-1 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">{{ $compagnie->name }}</h2>
                <p class="text-sm text-surface-500 dark:text-surface-400 line-clamp-2">{{ Str::limit($compagnie->description, 80) }}</p>
                <div class="mt-3 flex items-center text-primary-600 dark:text-primary-400 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                    Voir détails
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
