<?php

namespace App\Services;

use App\Models\Ticket\Ticket;
use App\Models\User;
use App\Models\Ticket\AutrePersonne;
use App\Models\Voyage\VoyageInstance;
use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
    
    /**
     * Get all tickets for the authenticated user
     *
     * @param string|null $status
     * @return Collection
     */
    public function getUserTickets(?string $status = null): Collection
    {
        $query = Ticket::with(['voyageInstance.voyage.trajet.depart', 'voyageInstance.voyage.trajet.arriver', 'voyageInstance.voyage.compagnie'])
            ->where('user_id', Auth::id());
            
        if ($status) {
            $query->where('statut', StatutTicket::from($status));
        }
        
        return $query->latest()->get();
    }
    
    /**
     * Get ticket details by ID
     *
     * @param string $id
     * @return Ticket
     */
    public function getTicketById(string $id): Ticket
    {
        return Ticket::with([
            'voyageInstance.voyage.trajet.depart', 
            'voyageInstance.voyage.trajet.arriver', 
            'voyageInstance.voyage.compagnie',
            'user',
            'autre_personne'
        ])
        ->where(function($query) {
            $query->where('user_id', Auth::id())
                  ->orWhere('transferer_a_user_id', Auth::id());
        })
        ->findOrFail($id);
    }
    
    /**
     * Create a new ticket
     *
     * @param array $data
     * @return Ticket
     */
    public function createTicket(array $data): Ticket
    {
        $voyageInstance = VoyageInstance::findOrFail($data['tripId']);
        $user = Auth::user();
        
        // Vérifier si le siège est disponible
        if (!in_array($data['seats'][0], $voyageInstance->chaiseDispo())) {
            throw new \Exception('Le siège sélectionné n\'est pas disponible');
        }
        
        // Créer un autre personne si le ticket n'est pas pour l'utilisateur lui-même
        $autrePersonneId = null;
        if (!$data['isForSelf']) {
            $autrePersonne = AutrePersonne::create([
                'nom' => $data['passengerName'],
                'contact' => $data['passengerPhone'] ?? null,
                'email' => $data['passengerEmail'] ?? null,
                'user_id' => $user->id,
                'relation' => $data['relationToPassenger'] ?? null
            ]);
            $autrePersonneId = $autrePersonne->id;
        }
        
        // Générer un code QR unique
        $qrCode = Str::uuid()->toString();
        $qrImagePath = 'qrcodes/' . $qrCode . '.png';
        
        // Générer l'image QR (dans un cas réel, on sauvegarderait l'image)
        QrCode::format('png')
            ->size(300)
            ->generate($qrCode, public_path($qrImagePath));
            
        // Créer le ticket
        $ticket = Ticket::create([
            'user_id' => $user->id,
            'voyage_instance_id' => $voyageInstance->id,
            'numero_chaise' => $data['seats'][0],
            'statut' => StatutTicket::Payer,
            'code_qr' => $qrCode,
            'code_qr_uri' => $qrImagePath,
            'date' => $voyageInstance->date,
            'type' => TypeTicket::from($data['tripType'] ?? 'one-way'),
            'is_my_ticket' => $data['isForSelf'],
            'autre_personne_id' => $autrePersonneId,
            'numero_ticket' => 'TK-' . Str::random(8)
        ]);
        
        return $ticket;
    }
    
    /**
     * Cancel a ticket
     *
     * @param string $id
     * @return Ticket
     */
    public function cancelTicket(string $id): Ticket
    {
        $ticket = $this->getTicketById($id);
        
        if ($ticket->statut === StatutTicket::Valider) {
            throw new \Exception('Un ticket validé ne peut pas être annulé');
        }
        
        $ticket->update([
            'statut' => StatutTicket::Annuler
        ]);
        
        return $ticket;
    }
    
    /**
     * Transfer a ticket to another user
     *
     * @param string $ticketId
     * @param string $recipientId
     * @return Ticket
     */
    public function transferTicket(string $ticketId, string $recipientId): Ticket
    {
        $ticket = $this->getTicketById($ticketId);
        $recipient = User::findOrFail($recipientId);
        
        if ($ticket->statut !== StatutTicket::Payer) {
            throw new \Exception('Seul un ticket payé peut être transféré');
        }
        
        $ticket->update([
            'transferer_a_user_id' => $recipient->id,
            'transferer_at' => now()
        ]);
        
        return $ticket;
    }
    
    /**
     * Get QR code for a ticket
     *
     * @param string $id
     * @return array
     */
    public function getTicketQrCode(string $id): array
    {
        $ticket = $this->getTicketById($id);
        
        return [
            'qrCode' => $ticket->code_qr,
            'qrImageUrl' => url($ticket->code_qr_uri)
        ];
    }
}
