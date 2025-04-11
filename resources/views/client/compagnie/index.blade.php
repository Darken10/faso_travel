@extends('layout')

@section('title','Compagnie')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Nos compagnies partenaires</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($compagnies as $compagnie)
                <a href="{{ route('client.compagnie.show', $compagnie) }}" class="block bg-white shadow-md rounded-2xl p-5 hover:shadow-xl transition duration-300 ease-in-out hover:scale-[1.02]">
                    <div class="flex items-center justify-center h-32 bg-gray-100 rounded-xl mb-4">
                        @if($compagnie->logo)
                            <img src="{{ asset('storage/' . $compagnie->logo) }}" alt="{{ $compagnie->nom }}" class="h-24 object-contain">
                        @else
                            <span class="text-gray-500">Pas de logo</span>
                        @endif
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $compagnie->name }}</h2>
                    <p class="text-sm text-gray-500">{{ Str::limit($compagnie->description, 80) }}</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection
