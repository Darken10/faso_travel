<?php

namespace App\Services;

use App\Models\Ticket\Ticket;
use App\Models\Voyage\VoyageInstance;
use App\Enums\StatutTicket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function getTodaysPaidPassengers()
    {
        $compagnieId = Auth::user()->compagnie_id;

        return Ticket::with(['user', 'voyageInstance.voyage.trajet.depart', 'voyageInstance.voyage.trajet.arriver'])
            ->whereHas('voyageInstance', function($query) {
                $query->whereDate('date', Carbon::today()->addDay());
            })
            ->whereHas('voyageInstance.voyage', function($query) use ($compagnieId) {
                $query->where('compagnie_id', $compagnieId);
            })
            ->where('statut', StatutTicket::Payer)
            ->get();
    }


    public function getTodaysValidatedTickets()
    {
        $compagnieId = Auth::user()->compagnie_id;

        return Ticket::with(['user', 'voyageInstance.voyage.trajet.depart', 'voyageInstance.voyage.trajet.arriver'])
            ->whereHas('voyageInstance.voyage', function($query) use ($compagnieId) {
                $query->where('compagnie_id', $compagnieId);
            })
            ->whereDate('valider_at', Carbon::today())
            ->where('statut', StatutTicket::Valider)
            ->get();
    }

    public function getTodayVoyageInstances()
    {
        $compagnieId = Auth::user()->compagnie_id;

        return VoyageInstance::with(['voyage.trajet.depart', 'voyage.trajet.arriver', 'chauffer'])
            ->whereDate('date', Carbon::today())
            ->whereHas('voyage', function($query) use ($compagnieId) {
                $query->where('compagnie_id', $compagnieId);
            })
            ->get();
    }

    public function getTicketsByVoyageInstance(string $voyageInstanceId)
    {
        $compagnieId = Auth::user()->compagnie_id;

        return Ticket::with(['user', 'voyageInstance.voyage.trajet'])
            ->where('voyage_instance_id', $voyageInstanceId)
            ->whereHas('voyageInstance.voyage', function($query) use ($compagnieId) {
                $query->where('compagnie_id', $compagnieId);
            })
            ->get();
    }

    public function getAllValidatedTickets(): Collection
    {
        $compagnieId = Auth::user()->compagnie_id;

        return Ticket::with(['user', 'voyageInstance.voyage.trajet.depart', 'voyageInstance.voyage.trajet.arriver'])
            ->whereHas('voyageInstance.voyage', function($query) use ($compagnieId) {
                $query->where('compagnie_id', $compagnieId);
            })
            ->where('statut', StatutTicket::Valider)
            ->orderBy('valider_at', 'desc')
            ->get();
    }

    public function findTicketById(string $id)
    {
        return Ticket::with(['user', 'autre_personne', 'voyageInstance.voyage.trajet'])
            ->findOrFail($id);
    }

    public function findTicketByQrCode(string $qrCode)
    {
        return Ticket::with(['user', 'autre_personne', 'voyageInstance.voyage.trajet'])
            ->where('code_qr', $qrCode)
            ->firstOrFail();
    }

    public function findTicketByPhoneAndCode(string $phone, string $code)
    {
        return Ticket::with(['user', 'autre_personne', 'voyageInstance.voyage.trajet'])
            ->where(function($query) use ($phone, $code) {
                $query->whereHas('user', function($q) use ($phone) {
                    $q->where('numero', $phone);
                })
                ->orWhereHas('autre_personne', function($q) use ($phone) {
                    $q->where('contact', $phone);
                });
            })
            ->where('code_sms', $code)
            ->firstOrFail();
    }
}
