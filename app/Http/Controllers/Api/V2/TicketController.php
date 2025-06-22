<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Get all tickets for the authenticated user
     *
     * @return JsonResponse
     */
    public function getUserTickets(): JsonResponse
    {
        try {
            $tickets = $this->ticketService->getUserTickets();

            return response()->json([
                'status' => 'success',
                'message' => 'Tickets récupérés avec succès',
                'data' => $tickets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get ticket details by ID
     *
     * @param string $ticketId
     * @return JsonResponse
     */
    public function getUserTicketDetails(string $ticketId): JsonResponse
    {
        try {
            $ticket = $this->ticketService->getUserTicketDetails($ticketId);

            return response()->json([
                'status' => 'success',
                'message' => 'Détails du ticket récupérés avec succès',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Create a new ticket
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createTicket(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'voyage_instance_id' => 'required|exists:voyage_instances,id',
                'type' => 'sometimes|string',
                'autre_personne' => 'sometimes|boolean',
                'nom_autre_personne' => 'required_if:autre_personne,true|string|max:255',
                'prenom_autre_personne' => 'required_if:autre_personne,true|string|max:255',
                'telephone_autre_personne' => 'required_if:autre_personne,true|string|max:20',
            ]);

            $ticket = $this->ticketService->createTicket($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket créé avec succès',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Cancel a ticket
     *
     * @param string $ticketId
     * @return JsonResponse
     */
    public function cancelTicket(string $ticketId): JsonResponse
    {
        try {
            $ticket = $this->ticketService->cancelTicket($ticketId);

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket annulé avec succès',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Transfer a ticket to another user
     *
     * @param Request $request
     * @param string $ticketId
     * @return JsonResponse
     */
    public function transferTicket(Request $request, string $ticketId): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'telephone' => 'required|string|max:20',
            ]);

            $ticket = $this->ticketService->transferTicket($ticketId, $validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket transféré avec succès',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get QR code for a ticket
     *
     * @param string $ticketId
     * @return JsonResponse
     */
    public function getTicketQrCode(string $ticketId): JsonResponse
    {
        try {
            $qrCode = $this->ticketService->getTicketQrCode($ticketId);

            return response()->json([
                'status' => 'success',
                'message' => 'QR code récupéré avec succès',
                'data' => ['qr_code' => $qrCode]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
