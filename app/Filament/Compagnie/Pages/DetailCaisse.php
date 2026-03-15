<?php

namespace App\Filament\Compagnie\Pages;

use App\Enums\StatutCaisse;
use App\Enums\StatutPayement;
use App\Models\Finance\Caisse;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class DetailCaisse extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $title = 'Détail de la Caisse';
    protected static ?int $navigationSort = 3;
    protected static string $view = 'filament.compagnie.pages.detail-caisse';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $slug = 'detail-caisse/{caisse}';

    public ?int $caisse = null;

    public function mount(int $caisse): void
    {
        $this->caisse = $caisse;

        $record = $this->getCaisse();
        if (!$record || $record->user_id !== Auth::id()) {
            abort(403);
        }
    }

    public function getCaisse(): ?Caisse
    {
        return Caisse::with('user', 'tickets.payements', 'tickets.voyageInstance', 'tickets.autre_personne')
            ->find($this->caisse);
    }

    public function getStatsProperty(): array
    {
        $caisse = $this->getCaisse();
        if (!$caisse) {
            return [];
        }

        $tickets = $caisse->tickets;
        $totalVentes = 0;

        foreach ($tickets as $ticket) {
            $totalVentes += $ticket->payements
                ->where('statut', StatutPayement::Complete)
                ->sum('montant');
        }

        $montantAttendu = $caisse->montant_ouverture + $totalVentes;
        $ecart = $caisse->montant_fermeture !== null
            ? $caisse->montant_fermeture - $montantAttendu
            : null;

        // Group by payment method
        $ventesParMethode = [];
        foreach ($tickets as $ticket) {
            foreach ($ticket->payements->where('statut', StatutPayement::Complete) as $payement) {
                $methode = $payement->moyen_payment?->value ?? 'Inconnu';
                $ventesParMethode[$methode] = ($ventesParMethode[$methode] ?? 0) + $payement->montant;
            }
        }

        // Hourly distribution
        $ventesParHeure = [];
        foreach ($tickets as $ticket) {
            $heure = $ticket->created_at->format('H\h');
            $montant = $ticket->payements->where('statut', StatutPayement::Complete)->sum('montant');
            $ventesParHeure[$heure] = ($ventesParHeure[$heure] ?? 0) + $montant;
        }
        ksort($ventesParHeure);

        // Tickets per hour count
        $ticketsParHeure = [];
        foreach ($tickets as $ticket) {
            $heure = $ticket->created_at->format('H\h');
            $ticketsParHeure[$heure] = ($ticketsParHeure[$heure] ?? 0) + 1;
        }
        ksort($ticketsParHeure);

        // Destinations breakdown
        $destinations = [];
        foreach ($tickets as $ticket) {
            $instance = $ticket->voyageInstance;
            if ($instance) {
                $depart = $instance->villeDepart()?->name ?? '?';
                $arrivee = $instance->villeArrive()?->name ?? '?';
                $key = "$depart → $arrivee";
                $destinations[$key] = ($destinations[$key] ?? 0) + 1;
            }
        }
        arsort($destinations);

        // Duration
        $duree = $caisse->closed_at
            ? $caisse->opened_at->diffForHumans($caisse->closed_at, true)
            : $caisse->opened_at->diffForHumans(now(), true);

        return [
            'total_ventes' => $totalVentes,
            'nombre_tickets' => $tickets->count(),
            'montant_ouverture' => $caisse->montant_ouverture,
            'montant_fermeture' => $caisse->montant_fermeture,
            'montant_attendu' => $montantAttendu,
            'ecart' => $ecart,
            'ventes_par_methode' => $ventesParMethode,
            'ventes_par_heure' => $ventesParHeure,
            'tickets_par_heure' => $ticketsParHeure,
            'destinations' => $destinations,
            'duree' => $duree,
            'is_ouverte' => $caisse->statut === StatutCaisse::Ouverte,
        ];
    }

    public function getChartDataProperty(): array
    {
        $stats = $this->stats;

        // Hourly revenue chart
        $heureLabels = array_keys($stats['ventes_par_heure'] ?? []);
        $heureValues = array_values($stats['ventes_par_heure'] ?? []);
        $ticketHeureValues = [];
        foreach ($heureLabels as $label) {
            $ticketHeureValues[] = $stats['tickets_par_heure'][$label] ?? 0;
        }

        // Payment method chart
        $methodeLabels = array_keys($stats['ventes_par_methode'] ?? []);
        $methodeValues = array_values($stats['ventes_par_methode'] ?? []);

        // Destination chart
        $destLabels = array_keys($stats['destinations'] ?? []);
        $destValues = array_values($stats['destinations'] ?? []);

        return [
            'hourly' => [
                'labels' => $heureLabels,
                'revenue' => $heureValues,
                'tickets' => $ticketHeureValues,
            ],
            'methods' => [
                'labels' => $methodeLabels,
                'values' => $methodeValues,
            ],
            'destinations' => [
                'labels' => array_slice($destLabels, 0, 8),
                'values' => array_slice($destValues, 0, 8),
            ],
        ];
    }
}
