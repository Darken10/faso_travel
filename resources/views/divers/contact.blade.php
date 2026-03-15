@extends('layout')

@section('title','Contact')

@section('content')
<div class="max-w-3xl mx-auto">
    {{-- Header --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-50 dark:bg-primary-900/20 rounded-full mb-3">
            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Contact</span>
        </div>
        <h1 class="text-3xl font-bold text-surface-900 dark:text-white mb-2">Contactez-nous</h1>
        <p class="text-surface-500 dark:text-surface-400">Une question ou une suggestion ? Nous sommes à votre écoute.</p>
    </div>

    @livewire("divers.contact-form")
</div>
@endsection
