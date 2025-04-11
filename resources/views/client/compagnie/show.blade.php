@extends('layout')

@section('title','Compagnie')

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="flex items-center space-x-4">
                @if($compagnie->logo)
                    <img src="{{ asset('storage/' . $compagnie->logo) }}" alt="{{ $compagnie->name }}" class="h-20 w-20 object-contain rounded-full shadow">
                @else
                    <div class="h-20 w-20 bg-gray-200 rounded-full flex items-center justify-center text-gray-400">
                        N/A
                    </div>
                @endif

                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $compagnie->name }}</h1>

                    {{-- Étoiles --}}
                    <div class="flex items-center mt-1 space-x-1">
                        @php
                            $note = round($compagnie->avis_avg_note ?? 3);
                            $note = 4;
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $note ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm text-gray-500">({{ $compagnie->avis_count ?? 0 }} avis)</span>
                    </div>
                </div>
            </div>

            {{-- Bouton favori --}}
            @auth
                <form method="POST" >
                    @csrf
                    <button type="submit" class="mt-4 md:mt-0 bg-gray-100 hover:bg-red-100 text-red-500 px-4 py-2 rounded-xl font-medium flex items-center gap-2 transition">

                    </button>
                </form>
            @endauth
        </div>

        {{-- Description --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">À propos de cette compagnie</h2>
            <p class="text-gray-600 leading-relaxed">{{ $compagnie->description ?? 'Aucune description disponible.' }}</p>
        </div>

        {{-- Bouton réserver un voyage --}}
        <div class="mb-10">
            <a href="{{ route('voyage.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow transition text-lg">
                🎟️ Voir les voyages de cette compagnie
            </a>
        </div>

        {{-- Liste des voyages (optionnel) --}}
        @if ($compagnie->voyages->count())
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Voyages disponibles</h3>
                <div class="space-y-4 ">
                    @foreach ($compagnie->voyages as $voyage)
                        <div class="p-4 border rounded-xl shadow-sm hover:shadow-md transition flex justify-between items-center bg-white">
                            <div>
                                <h4 class="font-semibold text-gray-700">
                                    {{ $voyage->trajet->depart->name }} → {{ $voyage->trajet->arriver->name }}
                                </h4>
                                <p class="text-sm text-gray-500">Départ : {{ $voyage->heure }} — Prix : {{ $voyage->prix }} F</p>
                            </div>
                            <a href="{{ route('voyage.show', $voyage) }}" class="text-blue-600 hover:underline">Détails</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-gray-500">Aucun voyage trouvé pour cette compagnie pour le moment.</p>
        @endif

    </div>
@endsection
