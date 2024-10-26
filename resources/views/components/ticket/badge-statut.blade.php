@props(['statut'=>null])


<span
    @class([
    'bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400' => $statut=== App\Enums\StatutTicket::EnAttente,
    'bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-400 border border-gray-500' => $statut=== App\Enums\StatutTicket::Pause,
    'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400' => $statut=== App\Enums\StatutTicket::Annuler,
    'bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300' => $statut=== \App\Enums\StatutTicket::Valider,
    'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400' => $statut=== App\Enums\StatutTicket::Payer,

    ])
>
    {{ $statut  }}
</span>

