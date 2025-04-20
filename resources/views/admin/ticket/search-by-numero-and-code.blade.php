@extends('admin.layout')

@section('title','validation du ticket')

@section('content')

    <div class="card m-auto">
        <div class="text-center text-gray-600 text-xl font-bold ">Validation</div>
        <form action="{{ route('admin.validation.search-by-tel-and-code-page-post') }}" method="post">
            @csrf
            <div class="mt-4">
                <x-label for="numero" value="{{ __('Numero') }}" />
                <x-input id="numero" class="block mt-1 w-full" type="tel" name="numero" :value="old('numero')" required autofocus  />
                <x-input-error for="numero" />
            </div>
            <div class="mt-4">
                <x-label for="code" value="{{ __('Code') }}" />
                <x-input id="code" class="block mt-1 w-full" type="tel" name="code" :value="old('code')" required  />
                <x-input-error for="code" />
            </div>

            <div class="mt-4 flex w-full justify-end px-4">
                <button type="submit" class="btn-primary">Valider</button>
            </div>

        </form>
    </div>


@endsection
