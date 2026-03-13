<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\Ticket\TicketQueryService;
use App\Services\Ticket\TicketCommandService;
use App\DTOs\Ticket\CreateTicketDTO;
use App\DTOs\Ticket\TransferTicketDTO;
use App\Models\Voyage\VoyageInstance;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(
        private TicketQueryService $ticketQueryService,
        private TicketCommandService $ticketCommandService,
    ) {
    }

    /**
     * Get all tickets for the authenticated user
     */
    public function getUserTickets(): JsonResponse
    {
        $tickets = $this->ticketQueryService->getUserTickets();
        return response()->json($tickets);
    }

    /**
     * Get ticket details by ID
     */
    public function getUserTicketDetails(string $ticketId): JsonResponse
    {
        $ticket = $this->ticketQueryService->getUserTicketById($ticketId);
        return response()->json($ticket);
    }

    /**
     * Create a new ticket
     */
    public function createTicket(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'voyage_instance_id' => 'required|exists:voyage_instances,id',
            'type' => 'sometimes|string',
            'autre_personne' => 'sometimes|boolean',
            'nom_autre_personne' => 'required_if:autre_personne,true|string|max:255',
            'prenom_autre_personne' => 'required_if:autre_personne,true|string|max:255',
            'telephone_autre_personne' => 'required_if:autre_personne,true|string|max:20',
        ]);

        $dto = CreateTicketDTO::fromRequest($validated);
        $voyageInstance = VoyageInstance::findOrFail($dto->voyage_instance_id);
        $type = $dto->type ?? \App\Enums\TypeTicket::AllerSimple;

        $result = $this->ticketCommandService->createFromVoyageInstance($voyageInstance, $type);

        return response()->json($result, $result['created'] ? 201 : 200);
    }

    /**
     * Cancel a ticket
     */
    public function cancelTicket(string $ticketId): JsonResponse
    {
        $ticket = $this->ticketQueryService->getUserTicketById($ticketId);
        $this->ticketCommandService->cancel($ticket);
        return response()->json(['message' => 'Ticket annulé avec succès.']);
    }

    /**
     * Transfer a ticket to another user
     */
    public function transferTicket(Request $request, string $ticketId): JsonResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $ticket = $this->ticketQueryService->getUserTicketById($ticketId);
        // For V2 API transfer, create AutrePersonne and update ticket
        $autrePersonne = \App\Models\Ticket\AutrePersonne::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'contact' => $validated['telephone'],
        ]);

        $ticket->autre_personne_id = $autrePersonne->id;
        $ticket->save();

        return response()->json($ticket->fresh());
    }

    /**
     * Get QR code for a ticket
     */
    public function getTicketQrCode(string $ticketId): JsonResponse
    {
        $ticket = $this->ticketQueryService->getUserTicketById($ticketId);

        return response()->json([
            'qr_code' => $ticket->code_qr,
            'qr_image_url' => $ticket->code_qr_uri ? url('storage/' . $ticket->code_qr_uri) : null,
        ]);
    }
}
