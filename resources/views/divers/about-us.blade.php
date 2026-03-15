@extends('layout')

@section('title','À propos de nous')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Hero --}}
    <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-50 dark:bg-primary-900/20 rounded-full mb-4">
            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Notre histoire</span>
        </div>
        <h1 class="text-3xl sm:text-4xl font-bold text-surface-900 dark:text-white mb-4">À propos de nous</h1>
        <p class="text-lg text-surface-500 dark:text-surface-400 max-w-2xl mx-auto">
            <strong class="text-surface-900 dark:text-white">MonTransport</strong> est une plateforme innovante de réservation de tickets de transport en ligne au Burkina Faso. Notre mission est de rendre les déplacements plus simples, plus sûrs et plus accessibles pour tous.
        </p>
    </div>

    {{-- Vision --}}
    <div class="card mb-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
            </div>
            <h2 class="text-xl font-semibold text-surface-900 dark:text-white">Notre vision</h2>
        </div>
        <p class="text-surface-600 dark:text-surface-300 leading-relaxed">
            Nous croyons que la technologie peut améliorer la mobilité. Grâce à notre plateforme, les utilisateurs peuvent consulter les horaires, comparer les compagnies, réserver en quelques clics, et recevoir un ticket numérique avec QR code directement sur leur téléphone.
        </p>
    </div>

    {{-- Features grid --}}
    <div class="card mb-6">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-accent-100 dark:bg-accent-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-accent-600 dark:text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" /></svg>
            </div>
            <h2 class="text-xl font-semibold text-surface-900 dark:text-white">Ce que nous proposons</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach([
                ['icon' => 'M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z', 'text' => 'Réservation rapide de tickets de transport interurbain'],
                ['icon' => 'M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z', 'text' => 'Paiement sécurisé via Orange Money, Moov Money, Ligdicash'],
                ['icon' => 'M15 10.5a3 3 0 11-6 0 3 3 0 016 0z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z', 'text' => 'Géolocalisation des gares et visualisation des itinéraires'],
                ['icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z', 'text' => 'Notations et commentaires sur les compagnies de transport'],
                ['icon' => 'M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5', 'text' => 'Transfert de tickets entre utilisateurs'],
                ['icon' => 'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z', 'text' => 'Réservation pour un proche non inscrit'],
                ['icon' => 'M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155', 'text' => 'Support client réactif et disponible'],
            ] as $feature)
                <div class="flex items-start gap-3 p-3 rounded-xl bg-surface-50 dark:bg-surface-800">
                    <svg class="w-5 h-5 text-success-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}" /></svg>
                    <span class="text-sm text-surface-700 dark:text-surface-300">{{ $feature['text'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Team & Trust --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="card">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-success-100 dark:bg-success-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <h2 class="text-lg font-semibold text-surface-900 dark:text-white">Notre équipe</h2>
            </div>
            <p class="text-surface-600 dark:text-surface-300 leading-relaxed">
                MonTransport a été conçu par une équipe de passionnés de technologie, de mobilité et de service client. Chaque membre travaille à faire évoluer la plateforme pour répondre aux besoins réels des voyageurs.
            </p>
        </div>
        <div class="card">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
                </div>
                <h2 class="text-lg font-semibold text-surface-900 dark:text-white">Engagement de confiance</h2>
            </div>
            <p class="text-surface-600 dark:text-surface-300 leading-relaxed">
                La sécurité de vos données personnelles et la fiabilité du service sont notre priorité. Nous mettons tout en œuvre pour offrir une expérience fluide, sécurisée et transparente.
            </p>
        </div>
    </div>

    {{-- Contact CTA --}}
    <div class="card bg-gradient-to-r from-primary-600 to-primary-700 border-0 text-center">
        <h2 class="text-xl font-bold text-white mb-2">Une question ? Une suggestion ?</h2>
        <p class="text-primary-100 mb-4">Contactez-nous, nous sommes à votre écoute</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="/contact" class="inline-flex items-center gap-2 px-6 py-2.5 bg-white text-primary-700 font-semibold rounded-xl hover:bg-primary-50 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                Nous contacter
            </a>
            <a href="mailto:support@liptra.net" class="inline-flex items-center gap-2 px-6 py-2.5 bg-white/20 text-white font-medium rounded-xl hover:bg-white/30 transition-colors">
                support@liptra.net
            </a>
        </div>
    </div>
</div>
@endsection
