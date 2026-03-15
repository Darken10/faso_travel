@props(['statut'=>null])

<span
    @class([
    'badge badge-primary' => $statut === App\Enums\StatutTicket::EnAttente,
    'badge badge-neutral' => $statut === App\Enums\StatutTicket::Pause,
    'badge badge-danger' => $statut === App\Enums\StatutTicket::Annuler || $statut === App\Enums\StatutTicket::Bloquer || $statut === App\Enums\StatutTicket::Suspendre,
    'badge badge-warning' => $statut === \App\Enums\StatutTicket::Valider,
    'badge badge-success' => $statut === App\Enums\StatutTicket::Payer,
    ])
>
    {{ $statut }}
</span>

