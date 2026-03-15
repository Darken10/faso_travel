@props(['ticket'])
<a href="{{ route('ticket.show-ticket',$ticket) }}" class="block group">
    <div @class([
        'card relative overflow-hidden transition-all duration-300 hover:shadow-elevated hover:-translate-y-0.5',
        'border-l-4',
        'border-l-danger-500' => $ticket->statut === \App\Enums\StatutTicket::Bloquer || $ticket->statut === \App\Enums\StatutTicket::Suspendre,
        'border-l-warning-500' => $ticket->statut === \App\Enums\StatutTicket::Pause,
        'border-l-success-500' => $ticket->statut === \App\Enums\StatutTicket::Payer,
        'border-l-primary-500' => $ticket->statut === \App\Enums\StatutTicket::EnAttente,
        'border-l-purple-500' => $ticket->statut === \App\Enums\StatutTicket::Valider,
    ])>
        {{-- Status badge --}}
        <div class="absolute top-3 right-3">
            <x-ticket.badge-statut :statut="$ticket->statut" />
        </div>

        {{-- Ticket type --}}
        <div class="flex items-center gap-2 mb-3">
            <div class="w-7 h-7 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                @if($ticket?->type === \App\Enums\TypeTicket::AllerRetour)
                    <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                    </svg>
                @else
                    <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                @endif
            </div>
            <span class="text-xs font-medium text-surface-500 dark:text-surface-400 uppercase tracking-wide">{{ $ticket->type }}</span>
        </div>

        {{-- Route --}}
        <div class="flex items-center gap-3 mb-4">
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-surface-900 dark:text-white truncate">{{ $ticket->villeDepart()->name }}</p>
                <p class="text-xs text-surface-400 dark:text-surface-500">{{ $ticket->villeDepart()->region->pays->iso2 }}</p>
            </div>

            <div class="flex flex-col items-center flex-shrink-0 px-2">
                <div class="flex items-center gap-1">
                    <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                    <div class="w-12 h-px bg-surface-300 dark:bg-surface-600"></div>
                    <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                    <div class="w-12 h-px bg-surface-300 dark:bg-surface-600"></div>
                    <div class="w-2 h-2 rounded-full bg-accent-500"></div>
                </div>
            </div>

            <div class="flex-1 min-w-0 text-right">
                <p class="font-semibold text-surface-900 dark:text-white truncate">{{ $ticket->villeArriver()->name }}</p>
                <p class="text-xs text-surface-400 dark:text-surface-500">{{ $ticket->villeArriver()->region->pays->iso2 }}</p>
            </div>
        </div>

        {{-- Date & Time --}}
        <div class="flex items-center justify-between pt-3 border-t border-surface-100 dark:border-surface-700">
            <div class="flex items-center gap-2 text-sm text-surface-600 dark:text-surface-300">
                <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <span>{{ $ticket?->date?->format('d M Y') }}</span>
            </div>
            @if($ticket?->voyageInstance?->heure)
                <div class="flex items-center gap-2 text-sm text-surface-600 dark:text-surface-300">
                    <svg class="w-4 h-4 text-surface-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $ticket->voyageInstance->heure->format('H\hi') }}</span>
                </div>
            @endif
            <svg class="w-5 h-5 text-surface-300 dark:text-surface-600 group-hover:text-primary-500 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </div>
    </div>
</a>
