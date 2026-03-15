@extends('layout')

@section('title','Politique de confidentialité')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="mb-8">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary-50 dark:bg-primary-900/20 rounded-full mb-3">
            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" /></svg>
            <span class="text-sm font-medium text-primary-700 dark:text-primary-300">Confidentialité</span>
        </div>
        <h1 class="text-3xl font-bold text-surface-900 dark:text-white mb-2">Politique de confidentialité</h1>
        <p class="text-surface-500 dark:text-surface-400">Comment nous collectons, utilisons et protégeons vos données personnelles.</p>
    </div>

    <div class="card prose prose-surface dark:prose-invert max-w-none
        prose-headings:text-surface-900 dark:prose-headings:text-white
        prose-h2:text-lg prose-h2:font-semibold prose-h2:mt-8 prose-h2:mb-3
        prose-p:text-surface-600 dark:prose-p:text-surface-300 prose-p:leading-relaxed
        prose-li:text-surface-600 dark:prose-li:text-surface-300
        prose-ul:space-y-1
        prose-a:text-primary-600 dark:prose-a:text-primary-400 prose-a:no-underline hover:prose-a:underline">

    <p class="mb-6">Cette politique de confidentialité explique comment nous collectons, utilisons, stockons et protégeons vos données personnelles lorsque vous utilisez notre plateforme de vente de tickets de transport.</p>

    <h2 class="text-xl font-semibold mb-2">1. Données collectées</h2>
    <p class="mb-4">Nous collectons les informations suivantes lors de l'inscription, de l'achat ou de l'utilisation de nos services :</p>
    <ul class="list-disc list-inside mb-4">
        <li>Nom et prénom</li>
        <li>Adresse e-mail</li>
        <li>Numéro de téléphone</li>
        <li>Genre</li>
        <li>Informations de paiement (via les services tiers sécurisés)</li>
        <li>Données de géolocalisation</li>
        <li>Historique d'achat de tickets</li>
        <li>Commentaires publiés sur la plateforme</li>
    </ul>

    <h2 class="text-xl font-semibold mb-2">2. Finalités de la collecte</h2>
    <p class="mb-4">Les données collectées nous permettent de :</p>
    <ul class="list-disc list-inside mb-4">
        <li>Créer et gérer votre compte utilisateur</li>
        <li>Faciliter la réservation, l’achat et le transfert de tickets</li>
        <li>Assurer un suivi fiable des transactions et des trajets</li>
        <li>Fournir une géolocalisation des gares et compagnies</li>
        <li>Envoyer des notifications utiles (confirmation de paiement, rappels, modifications de voyage...)</li>
        <li>Améliorer la qualité de nos services et prévenir les fraudes</li>
    </ul>

    <h2 class="text-xl font-semibold mb-2">3. Base légale</h2>
    <p class="mb-4">Nous traitons vos données personnelles sur la base de votre consentement, de l'exécution d'un contrat (ex. achat de ticket), ou d'une obligation légale (ex. lutte contre la fraude).</p>

    <h2 class="text-xl font-semibold mb-2">4. Partage des données</h2>
    <p class="mb-4">Vos données personnelles ne sont jamais vendues. Elles peuvent être partagées avec :</p>
    <ul class="list-disc list-inside mb-4">
        <li>Les administrateurs de la plateforme (à des fins de gestion technique et de sécurité)</li>
        <li>Les compagnies de transport concernées par vos réservations</li>
        <li>Les autres utilisateurs (en cas de transfert de ticket)</li>
    </ul>

    <h2 class="text-xl font-semibold mb-2">5. Services de paiement</h2>
    <p class="mb-4">Les paiements sont traités par des prestataires tiers (Orange Money, Moov Money, Ligdicash). Ces prestataires ont leurs propres politiques de confidentialité. Nous ne stockons aucune information de carte bancaire ou de compte mobile sur nos serveurs.</p>

    <h2 class="text-xl font-semibold mb-2">6. Géolocalisation</h2>
    <p class="mb-4">Nous utilisons la géolocalisation pour afficher les gares les plus proches de vous. Cette fonctionnalité est facultative et peut être désactivée dans les réglages de votre appareil mobile.</p>

    <h2 class="text-xl font-semibold mb-2">7. Durée de conservation</h2>
    <p class="mb-4">Vos données sont conservées aussi longtemps que votre compte est actif. Vous pouvez demander leur suppression à tout moment, sauf si une conservation est imposée par la loi (ex. obligations fiscales).</p>

    <h2 class="text-xl font-semibold mb-2">8. Sécurité des données</h2>
    <p class="mb-4">Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger vos données contre tout accès non autorisé, modification ou perte. L'accès aux données est strictement limité au personnel autorisé.</p>

    <h2 class="text-xl font-semibold mb-2">9. Vos droits</h2>
    <p class="mb-4">Conformément aux lois en vigueur, vous disposez des droits suivants :</p>
    <ul class="list-disc list-inside mb-4">
        <li>Droit d’accès à vos données</li>
        <li>Droit de rectification en cas d’erreur</li>
        <li>Droit à l’effacement de vos données</li>
        <li>Droit d’opposition au traitement dans certains cas</li>
        <li>Droit à la portabilité de vos données</li>
    </ul>
    <p class="mb-4">Vous pouvez exercer ces droits via votre espace personnel ou en nous contactant à l’adresse indiquée dans l’application.</p>

    <h2 class="text-xl font-semibold mb-2">10. Mise à jour de la politique</h2>
    <p class="mb-4">Cette politique peut être mise à jour à tout moment. En cas de modification importante, vous en serez informé par notification ou e-mail. La date de mise à jour est indiquée ci-dessous.</p>

    <p class="text-sm text-gray-500 mt-6">Dernière mise à jour : Avril 2025</p>
</section>
@endsection
