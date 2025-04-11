@extends('layout')

@section('title','Conditions Générales d\'Utilisation')

@section('content')
<section class="max-w-5xl mx-auto px-4 py-12 text-gray-800">
    <h1 class="text-3xl font-bold mb-6">À propos de nous</h1>

    <p class="text-lg mb-6 text-gray-700 leading-relaxed">
        <strong>MonTransport</strong> est une plateforme innovante de réservation de tickets de transport en ligne au Burkina Faso. Notre mission est de rendre les déplacements plus simples, plus sûrs et plus accessibles pour tous.
    </p>

    <h2 class="text-2xl font-semibold mt-10 mb-3">Notre vision</h2>
    <p class="text-gray-700 leading-relaxed mb-6">
        Nous croyons que la technologie peut améliorer la mobilité. Grâce à notre plateforme, les utilisateurs peuvent consulter les horaires, comparer les compagnies, réserver en quelques clics, et recevoir un ticket numérique avec QR code directement sur leur téléphone.
    </p>

    <h2 class="text-2xl font-semibold mt-10 mb-3">Ce que nous proposons</h2>
    <ul class="list-disc pl-6 space-y-2 text-gray-700">
        <li>Réservation rapide de tickets de transport interurbain</li>
        <li>Paiement sécurisé via Orange Money, Moov Money, Ligdicash, etc.</li>
        <li>Géolocalisation des gares et visualisation des itinéraires sur Google Maps</li>
        <li>Notations et commentaires sur les compagnies de transport</li>
        <li>Fonction de transfert de tickets entre utilisateurs</li>
        <li>Possibilité de réserver pour un proche non inscrit</li>
        <li>Support client réactif et disponible</li>
    </ul>

    <h2 class="text-2xl font-semibold mt-10 mb-3">Notre équipe</h2>
    <p class="text-gray-700 leading-relaxed mb-6">
        MonTransport a été conçu par une équipe de passionnés de technologie, de mobilité et de service client. Chaque membre travaille à faire évoluer la plateforme pour répondre aux besoins réels des voyageurs, des compagnies de transport et des administrateurs.
    </p>

    <h2 class="text-2xl font-semibold mt-10 mb-3">Engagement de confiance</h2>
    <p class="text-gray-700 leading-relaxed mb-6">
        La sécurité de vos données personnelles et la fiabilité du service sont notre priorité. Nous mettons tout en œuvre pour offrir une expérience fluide, sécurisée et transparente.
    </p>

    <h2 class="text-2xl font-semibold mt-10 mb-3">Nous contacter</h2>
    <p class="text-gray-700 leading-relaxed">
        Une question ? Une suggestion ? Contactez-nous depuis notre <a href="/contact" class="text-blue-600 hover:underline">page de contact</a> ou écrivez-nous directement à <a href="mailto:support@liptra.net" class="text-blue-600 hover:underline">support@liptra.net</a>.
    </p>
</section>
@endsection
