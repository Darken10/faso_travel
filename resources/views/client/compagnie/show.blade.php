@extends('layout')

@section('title', $compagnie->name)

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Header Card --}}
    <div class="card mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-5">
            @if($compagnie->logo)
                <div class="w-20 h-20 rounded-2xl bg-surface-50 dark:bg-surface-800 flex items-center justify-center flex-shrink-0 overflow-hidden">
                    <img src="{{ asset('storage/' . $compagnie->logo) }}" alt="{{ $compagnie->name }}" class="h-16 object-contain">
                </div>
            @else
                <div class="w-20 h-20 rounded-2xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                    <svg class="w-10 h-10 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                </div>
            @endif

            <div class="flex-1">
                <h1 class="text-2xl font-bold text-surface-900 dark:text-white">{{ $compagnie->name }}</h1>
                {{-- Stars --}}
                <div class="flex items-center gap-1 mt-1.5">
                    @php $note = round($compagnie->avis_avg_note ?? 3); @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $note ? 'text-accent-500' : 'text-surface-200 dark:text-surface-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
                    @endfor
                    <span class="ml-1.5 text-sm text-surface-500 dark:text-surface-400">({{ $compagnie->avis_count ?? 0 }} avis)</span>
                </div>
            </div>

            <a href="{{ route('voyage.index') }}" class="btn-primary flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" /></svg>
                Voir les voyages
            </a>
        </div>
    </div>

    {{-- Description --}}
    @if($compagnie->description)
        <div class="card mb-6">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <svg class="w-4.5 h-4.5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>
                </div>
                <h2 class="text-lg font-semibold text-surface-900 dark:text-white">À propos</h2>
            </div>
            <p class="text-surface-600 dark:text-surface-300 leading-relaxed">{{ $compagnie->description }}</p>
        </div>
    @endif

    {{-- Voyages --}}
    @if ($compagnie->voyages->count())
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-surface-900 dark:text-white mb-4">Voyages disponibles</h3>
            <div class="space-y-3">
                @foreach ($compagnie->voyages as $voyage)
                    <a href="{{ route('voyage.show', $voyage) }}" class="card group flex items-center justify-between hover:shadow-elevated transition-all duration-200">
                        <div>
                            <div class="flex items-center gap-2 text-surface-900 dark:text-white font-semibold">
                                <span>{{ $voyage->trajet->depart->name }}</span>
                                <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                <span>{{ $voyage->trajet->arriver->name }}</span>
                            </div>
                            <div class="flex items-center gap-4 mt-1.5 text-sm text-surface-500 dark:text-surface-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $voyage->heure }}
                                </span>
                                <span class="font-semibold text-primary-600 dark:text-primary-400">{{ number_format($voyage->prix, 0, ',', ' ') }} F</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-surface-300 group-hover:text-primary-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="card text-center py-10">
            <div class="w-14 h-14 rounded-2xl bg-surface-100 dark:bg-surface-800 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>
            </div>
            <p class="text-surface-500 dark:text-surface-400">Aucun voyage disponible pour cette compagnie pour le moment.</p>
        </div>
    @endif
</div>
@endsection
