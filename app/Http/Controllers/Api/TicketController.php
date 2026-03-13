<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketDetailResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\VoyageInstanceResource;
use App\Services\Ticket\TicketQueryService;
use App\Services\Ticket\TicketCommandService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct(
        private TicketQueryService $ticketQueryService,
        private TicketCommandService $ticketCommandService,
    ) {
    }

    /**
     * Check if user has compagnie access
     */
    private function checkCompagnieAccess()
    {
        if (!Auth::user()->compagnie_id) {
            abort(403, 'Accès non autorisé - Utilisateur non associé à une compagnie');
        }
    }

    /**
     * Get all tickets for the authenticated user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserTickets(Request $request)
    {
        try {
            $status = $request->input('status');
            $statusEnum = $status ? \App\Enums\StatutTicket::tryFrom($status) : null;
            $tickets = $this->ticketQueryService->getUserTickets($statusEnum);

            return response()->json([
                'status' => 'success',
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
     * Get ticket details for the authenticated user
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserTicketDetails(string $id)
    {
        try {
            $ticket = $this->ticketQueryService->getUserTicketById($id);

            return response()->json([
                'status' => 'success',
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function createTicket(Request $request)
    {
        $request->validate([
            'voyage_instance_id' => 'required|exists:voyage_instances,id',
            'seat_number' => 'required|integer|min:1',
            'is_autre_personne' => 'required|boolean',
            'autre_personne_name' => 'required_if:is_autre_personne,true|string|max:255',
            'autre_personne_phone' => 'required_if:is_autre_personne,true|string|max:20',
        ]);

        try {
            $voyageInstance = \App\Models\Voyage\VoyageInstance::findOrFail($request->input('voyage_instance_id'));
            $result = $this->ticketCommandService->createFromVoyageInstance($voyageInstance, \App\Enums\TypeTicket::AllerSimple);
            $ticket = $result['ticket'];

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel a ticket
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelTicket(string $id)
    {
        try {
            $ticket = $this->ticketQueryService->getUserTicketById($id);
            $result = $this->ticketCommandService->cancel($ticket);

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket cancelled successfully',
                'data' => $result
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
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function transferTicket(Request $request, string $id)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            $ticket = $this->ticketQueryService->getUserTicketById($id);
            $recipient = \App\Models\User::where('email', $request->email)->firstOrFail();
            $result = $this->ticketCommandService->transfer($ticket, $recipient, $request->input('password', ''));

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket transferred successfully',
                'data' => $result
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
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTicketQrCode(string $id)
    {
        try {
            $ticket = $this->ticketQueryService->getUserTicketById($id);
            $qrCode = ['qrCode' => $ticket->code_qr, 'qrImageUrl' => url($ticket->code_qr_uri)];

            return response()->json([
                'status' => 'success',
                'data' => [
                    'qr_code' => $qrCode
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get today's paid passengers (compagnie access)
     *
     * @return AnonymousResourceCollection
     */
    public function todaysPaidPassengers(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketQueryService->getTodaysPaidPassengers();
        return TicketResource::collection($tickets);
    }

    /**
     * Get today's validated tickets (compagnie access)
     *
     * @return AnonymousResourceCollection
     */
    public function todaysValidatedTickets(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketQueryService->getTodaysValidatedTickets();
        return TicketResource::collection($tickets);
    }

    /**
     * Get today's voyage instances (compagnie access)
     *
     * @return AnonymousResourceCollection
     */
    public function todayVoyageInstances(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $voyageInstances = $this->ticketQueryService->getTodayVoyageInstances();
        return VoyageInstanceResource::collection($voyageInstances);
    }

    /**
     * Get tickets by voyage instance (compagnie access)
     *
     * @param string $voyageInstanceId
     * @return AnonymousResourceCollection
     */
    public function ticketsByVoyageInstance(string $voyageInstanceId): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketQueryService->getTicketsByVoyageInstance($voyageInstanceId);
        return TicketResource::collection($tickets);
    }

    /**
     * Get all validated tickets (compagnie access)
     *
     * @return AnonymousResourceCollection
     */
    public function allValidatedTickets(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketQueryService->getAllValidatedTickets();
        return TicketResource::collection($tickets);
    }

    /**
     * Show ticket details (compagnie access)
     *
     * @param string $id
     * @return TicketDetailResource
     */
    public function show(string $id)
    {
        $this->checkCompagnieAccess();
        $ticket = $this->ticketQueryService->getUserTicketById($id);
        return new TicketDetailResource($ticket);
    }

    /**
     * Find ticket by QR code (compagnie access)
     *
     * @param string $code
     * @return TicketDetailResource
     */
    public function findByQrCode(string $code)
    {
        $this->checkCompagnieAccess();
        $ticket = $this->ticketQueryService->findByQrCode($code);
        return new TicketDetailResource($ticket);
    }

    /**
     * Find ticket by phone and code (compagnie access)
     *
     * @param Request $request
     * @return TicketDetailResource
     */
    public function findByPhoneAndCode(Request $request)
    {
        $this->checkCompagnieAccess();
        $validated = $request->validate([
            'phone' => 'required|string',
            'code' => 'required|string'
        ]);

        $ticket = $this->ticketQueryService->findByPhoneAndCode(
            $validated['phone'],
            $validated['code']
        );
        return new TicketDetailResource($ticket);
    }
}
