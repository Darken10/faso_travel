<?php

namespace App\Services\V2;

use App\Enums\TypeTicket;
use App\Models\Ticket\AutrePersonne;
use App\Models\Voyage\VoyageInstance;
use App\Services\Ticket\TicketCommandService;

class BuyVoyageService
{
    public function __construct(
        private TicketCommandService $ticketCommandService,
    ) {
    }

    public function buyTicket(VoyageInstance $voyage_instance, array $data): array
    {
        $autrePersonne = null;
        if (!$data['isForSelf']) {
            $autrePersonne = AutrePersonne::create([
                'first_name' => $data['passenger']['first_name'],
                'last_name' => $data['passenger']['last_name'],
                'name' => strtoupper($data['passenger']['first_name']) . ' ' . $data['passenger']['last_name'],
                'email' => $data['passenger']['email'] ?? null,
                'sexe' => $data['passenger']['sexe'] ?? "Homme",
                'numero' => $data['passenger']['numero'] ?? null,
                'numero_identifiant' => $data['passenger']['numero_identifiant'] ?? '226',
                'lien_relation' => $data['passenger']['lien_relation'] ?? 'Autre',
            ]);
        }

        $type = ($data['tripType'] ?? 'one-way') === 'round-trip'
            ? TypeTicket::AllerRetour
            : TypeTicket::AllerSimple;

        $isMyTicket = $data['isForSelf'] && $autrePersonne === null;

        $result = $this->ticketCommandService->createFromVoyageInstance(
            voyageInstance: $voyage_instance,
            type: $type,
            isMyTicket: $isMyTicket,
            autrePersonne: $autrePersonne,
        );

        return [
            'success' => true,
            'message' => $result['message'],
            'ticket' => $result['ticket'] ?? null,
        ];
    }
}
        }

        return [
            'message' => 'Ticket created successfully',
        ];
    }
}
