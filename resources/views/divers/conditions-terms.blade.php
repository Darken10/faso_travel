@extends('layout')

@section('title','Conditions Générales d\'Utilisation')

@section('content')
<section class="max-w-4xl mx-auto px-4 py-10 text-gray-800">
    <h1 class="text-3xl font-bold mb-6">Conditions Générales d'Utilisation et de Vente</h1>

    <p class="mb-6">Les présentes conditions générales d'utilisation et de vente (ci-après désignées « CGUV ») régissent l’accès, la navigation et l’utilisation de notre plateforme numérique de vente de tickets de transport. En utilisant nos services, l’utilisateur accepte sans réserve l’intégralité des dispositions ci-dessous.</p>

    <h2 class="text-xl font-semibold mb-2">1. Présentation du service</h2>
    <p class="mb-4">La plateforme permet aux utilisateurs de rechercher, réserver et acheter des tickets de transport auprès de compagnies partenaires. Chaque ticket est associé à un trajet, une date, un horaire et un véhicule spécifiques.</p>

    <h2 class="text-xl font-semibold mb-2">2. Accès au service</h2>
    <ul class="list-disc list-inside mb-4">
        <li>La consultation du catalogue est libre, mais l’achat de ticket nécessite la création d’un compte utilisateur.</li>
        <li>Un utilisateur peut acheter un ticket pour un tiers non inscrit ; il en devient responsable et garant.</li>
        <li>Les utilisateurs doivent garantir l’exactitude des informations fournies lors de leur inscription.</li>
    </ul>

    <h2 class="text-xl font-semibold mb-2">3. Moyens de paiement</h2>
    <p class="mb-4">Les paiements s’effectuent via des solutions de paiement mobile partenaires telles que <strong>Orange Money</strong>, <strong>Moov Money</strong>, <strong>Ligdicash</strong>, etc. Toute transaction est confirmée par une notification et génère un ticket électronique.</p>

    <h2 class="text-xl font-semibold mb-2">4. Livraison des tickets</h2>
    <p class="mb-4">Après validation du paiement, un ticket électronique est automatiquement émis et envoyé à l’utilisateur sous forme de fichier PDF ou d’image contenant un code QR. Ce ticket est également disponible dans l’espace personnel du client.</p>

    <h2 class="text-xl font-semibold mb-2">5. Utilisation et présentation du ticket</h2>
    <p class="mb-4">Le ticket doit être présenté au responsable du voyage avant le départ. La validation se fait par scan du code QR. L’accès au véhicule peut être refusé en cas de ticket non valide ou déjà utilisé.</p>

    <h2 class="text-xl font-semibold mb-2">6. Transfert et cession de tickets</h2>
    <p class="mb-4">Un ticket peut être transféré à un autre utilisateur inscrit via l’interface dédiée. Cette action est irréversible et sous la responsabilité de l’expéditeur.</p>

    <h2 class="text-xl font-semibold mb-2">7. Modifications, annulations et remboursements</h2>
    <p class="mb-4">Les demandes de modification ou d’annulation sont soumises aux conditions spécifiques de la compagnie concernée. Dans certains cas, un ticket peut être mis en pause pour une réutilisation ultérieure.</p>

    <h2 class="text-xl font-semibold mb-2">8. Responsabilité</h2>
    <ul class="list-disc list-inside mb-4">
        <li>La plateforme agit comme intermédiaire entre les utilisateurs et les compagnies partenaires.</li>
        <li>Elle ne saurait être tenue responsable des retards, annulations ou incidents survenus lors des trajets.</li>
        <li>Les utilisateurs sont seuls responsables des activités effectuées depuis leur compte.</li>
    </ul>

    <h2 class="text-xl font-semibold mb-2">9. Contenus et interactions</h2>
    <p class="mb-4">Les utilisateurs peuvent commenter ou évaluer les voyages effectués. Les propos diffamatoires, offensants ou contraires à la loi seront supprimés, et l’auteur pourra être suspendu ou banni sans préavis.</p>

    <h2 class="text-xl font-semibold mb-2">10. Propriété intellectuelle</h2>
    <p class="mb-4">L’ensemble des éléments du site (logo, contenus, interfaces, algorithmes, etc.) est protégé par le droit de la propriété intellectuelle. Toute reproduction ou usage non autorisé est strictement interdit.</p>

    <h2 class="text-xl font-semibold mb-2">11. Protection des données</h2>
    <p class="mb-4">La plateforme collecte des données à caractère personnel nécessaires à la fourniture du service (nom, prénom, téléphone, email, genre, géolocalisation, historique d’achat, etc.). Ces données sont traitées conformément à notre <a href="{{ route('divers.termes-et-conditions') }}" class="text-blue-600 hover:underline">Politique de confidentialité</a>.</p>

    <h2 class="text-xl font-semibold mb-2">12. Sécurité</h2>
    <p class="mb-4">Nous mettons en œuvre des mesures de sécurité (chiffrement, journalisation, authentification à deux facteurs, etc.) pour protéger les données et les transactions. L’utilisateur s’engage à ne pas divulguer ses identifiants à des tiers.</p>

    <h2 class="text-xl font-semibold mb-2">13. Modification des CGUV</h2>
    <p class="mb-4">La plateforme se réserve le droit de modifier à tout moment les présentes CGUV. Les utilisateurs seront informés via l’interface de l’application ou par email. L’utilisation continue du service vaut acceptation des nouvelles conditions.</p>

    <h2 class="text-xl font-semibold mb-2">14. Droit applicable et juridiction compétente</h2>
    <p class="mb-4">Les présentes CGUV sont régies par le droit du Burkina Faso. En cas de litige, une tentative de médiation ou de conciliation sera privilégiée. À défaut, les juridictions compétentes de Bobo-Dioulasso ou Ouagadougou seront saisies.</p>

    <p class="text-sm text-gray-500 mt-6">Dernière mise à jour : Avril 2025</p>
</section>
@endsection
