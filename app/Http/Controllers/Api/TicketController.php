<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketDetailResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\VoyageInstanceResource;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticketService)
    {
    }

    private function checkCompagnieAccess()
    {
        if (!Auth::user()->compagnie_id) {
            abort(403, 'Accès non autorisé - Utilisateur non associé à une compagnie');
        }
    }

    public function todaysPaidPassengers(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketService->getTodaysPaidPassengers();
        return TicketResource::collection($tickets);
    }

    public function todaysValidatedTickets(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketService->getTodaysValidatedTickets();
        return TicketResource::collection($tickets);
    }

    public function todayVoyageInstances(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $voyageInstances = $this->ticketService->getTodayVoyageInstances();
        return VoyageInstanceResource::collection($voyageInstances);
    }

    public function ticketsByVoyageInstance(string $voyageInstanceId): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketService->getTicketsByVoyageInstance($voyageInstanceId);
        return TicketResource::collection($tickets);
    }

    public function allValidatedTickets(): AnonymousResourceCollection
    {
        $this->checkCompagnieAccess();
        $tickets = $this->ticketService->getAllValidatedTickets();
        return TicketResource::collection($tickets);
    }

    public function show(string $id)
    {
        $this->checkCompagnieAccess();
        $ticket = $this->ticketService->findTicketById($id);
        return new TicketDetailResource($ticket);
    }

    public function findByQrCode(string $code)
    {
        $this->checkCompagnieAccess();
        $ticket = $this->ticketService->findTicketByQrCode($code);
        return new TicketDetailResource($ticket);
    }

    public function findByPhoneAndCode(Request $request)
    {
        $this->checkCompagnieAccess();
        $validated = $request->validate([
            'phone' => 'required|string',
            'code' => 'required|string'
        ]);

        $ticket = $this->ticketService->findTicketByPhoneAndCode(
            $validated['phone'],
            $validated['code']
        );
        return new TicketDetailResource($ticket);
    }
}
