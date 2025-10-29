<?php

namespace App\Services\Admin;

use App\Models\Ticket\Ticket;
use App\Models\Voyage\Voyage;
use Illuminate\Support\Facades\Auth;
use App\Models\Voyage\VoyageInstance;

class VoyageTicketService
{
    public function __construct()
    {
    }

    public function getVoyageInstancesByDate($date = null)
    {
        if(!$date){
            $date = date('Y-m-d');
        }
        
        $compagnieId = Auth::user()->compagnie_id;
        return VoyageInstance::whereHas('voyage', function($query) use ($compagnieId) {
            $query->where('compagnie_id', $compagnieId);
        })
        ->with(['voyage.trajet.depart', 'voyage.trajet.arriver', 'tickets'])
        ->whereDate('date', $date)
        ->get();
    }

    public function getTicketsByVoyageInstance($voyageInstanceId)
    {
        return Ticket::where('voyage_instance_id', $voyageInstanceId)
            ->with(['user:id,name,email', 'autre_personne'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'numero_ticket' => $ticket->numero_ticket,
                    'numero_place' => $ticket->numero_chaise,
                    'statut' => $ticket->statut,
                    'type' => $ticket->type,
                    'created_at' => $ticket->created_at->format('Y-m-d H:i:s'),
                    'passager' => $ticket->is_my_ticket ? [
                        'id' => $ticket->user->id,
                        'name' => $ticket->user->name,
                        'email' => $ticket->user->email
                    ] : [
                        'id' => $ticket->autre_personne->id,
                        'name' => $ticket->autre_personne->name,
                        'numero' => $ticket->autre_personne->numero
                    ]
                ];
            });
    }
}
